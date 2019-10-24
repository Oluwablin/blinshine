<?php

namespace App\Http\Controllers;

use Auth;
use PDF;
use App\User;
use App\Client;
use App\Project;
use App\Invoice;
use App\Estimate;
use Carbon\Carbon;
use App\Mail\SendInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Notifications\UserNotification;
use App\Traits\VerifyandStoreTransactions;

class InvoiceController extends Controller
{
    use VerifyandStoreTransactions;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function send($id){
        return view('invoice_sent');
    }

    public function index(){
        $user = Auth::user();

        // return $user->projects;

        $invoices = $user->projects()->select('id', 'title', 'client_id')->with(['client:id,name', 'invoice:id,project_id,amount,status,issue_date,created_at'])->get();

        foreach ($invoices as $key => $invoice) {
            if($invoice->invoice == null){
                unset($invoices[$key]);
            }

                        if($invoice->client_id == null){
                unset($invoices[$key]);
            }

        }
        // return $invoices;
        return view('invoices.invoicelist')->with('invoices', $invoices);
    }

    /**
     * Creates new record in the invoice table
     */
    public function store(Request $request){

        $this->validate($request, [
            'estimate_id' => 'required|numeric'
        ]);

        $estimate = Estimate::findOrFail($request->estimate_id);

        $pre_invoice = Invoice::where('estimate_id', $request->estimate_id)->first();

        if($pre_invoice !== null){

            $pre_invoice->update(['amount' => $estimate->estimate]);

            $invoice = $pre_invoice;
        }else{

            $invoice = Invoice::create(['project_id' => $estimate->project_id, 'estimate_id' => $estimate->id, 'amount' => $estimate->estimate]);
        }

        // dd($invoice->project);

        $invoice->project->client;
        $invoice->estimate = $estimate;

        // dd($invoice);
        // return $invoice;
        return view('invoices.reviewinvoice')->with('invoice', $invoice);
    }


    public function delete(Request $request, $invoice){
        $invoice = Invoice::findOrFail($invoice);

        $user = Auth::user();

        if($invoice->project->user_id !== $user->id){
            $request->session()->flash('error', "You're unauthorized to delete this invoice");
            return redirect()->back();
        }else{
            $request->session()->flash('status', 'Deleted');
            return redirect()->back();
        }
    }

    public function show($invoice)
    {
        $invoice = Invoice::findOrFail($invoice);

        // dd($invoice);
        $project_id = $invoice->project_id;

        $invoice = Project::where('id', $project_id)->select('id','title', 'estimate_id', 'client_id')->with(['estimate', 'invoice', 'client'])->first();

        // return $invoice;
        return view('invoices.viewinvoice')->with('invoice', $invoice);
    }

    public function list(){
        $filter = Request()->filter ?? false;
        if($filter && !in_array($filter, ['all', 'paid', 'unpaid'])) $filter = false;

        $invoices = Invoice::join('projects', 'projects.id', 'invoices.project_id')
                            ->join('clients', 'clients.id', 'projects.client_id')
                    ->leftjoin('currencies AS ic', 'invoices.currency_id', 'ic.id')
                    ->where('projects.user_id', Auth::user()->id);
        
        if($filter && $filter !== 'all') $invoices = $invoices->where('invoices.status', $filter);
        
        $invoices = $invoices->select('invoices.*', 'clients.name AS client', 'projects.title AS project_title', 'ic.symbol AS invoice_currency')
                    ->get();
        
        // $result = [];
        // $invoices = Auth::user()->projects;
        // if($invoices->count() > 0){
        //     foreach($invoices as $project){
        //         if($project->invoice !== null) array_push($result, $project->invoice);
        //     }
        // }
        return view('invoices.list')->withInvoices($invoices);
        // return $result->count() > 0 ? $this->SUCCESS('Invoice retrieved', $invoice) : $this->SUCCESS('No invoice found');
    }

    public function getPdf($invoice)
    {
        $invoice = Invoice::findOrFail($invoice);

        $filename = "invoice#".strtotime($invoice->created_at).".pdf";

        $project_id = $invoice->project_id;

        $invoice = Project::where('id', $project_id)->select('id','title', 'estimate_id', 'client_id')->with(['estimate', 'invoice', 'client'])->first();

            $pdf = PDF::loadView('invoices.pdf', ['invoice' => $invoice]);  

            return $pdf->download($filename);
    }

    public function sendinvoice(Request $request){
        $invoice_id = $request->invoice;

        $invoice = Invoice::findOrFail($invoice_id);

        $project_name = $invoice->project->title;

        $client = $invoice->project->client;

        $client_email = $client->email;

        $encoded = base64_encode(base64_encode($client_email));

        $url = "/clients/".$encoded."/invoices/".strtotime($invoice->created_at);

        $name = Auth::user()->name;

        Mail::to($client_email)
            ->send(new SendInvoice([
                'user' => $name,
                'name' => $client->name,
                'amount' => $invoice->amount,
                'invoice_url' => $url,
                'project' => $project_name
            ]));

        return view('invoices.invoicesent');
    }

public function clientInvoice($client, $invoice)
    {
        $client_email = base64_decode(base64_decode($client));
        $invoice = Invoice::where('created_at', Carbon::createFromTimestamp($invoice))->first();

        $project_id = $invoice->project_id;
        $invoice = Project::where('id', $project_id)->select('id','title', 'estimate_id', 'client_id')->with(['estimate', 'invoice', 'client'])->first();
        return view('invoices.clientinvoice')->with('invoice', $invoice);
    }

    public function pay($txref){
        $data = $this->verifyTransaction($txref);
        // dd($data);
        if($data['success']){            
            $invoice = Invoice::find($data['invoice_id']);
            $invoice->update(['status' => 'paid']);
            $project_name = $invoice->project->title;
            $user = User::find($invoice->project->user_id);
            $user->notify(new UserNotification([
                "subject" => "Invoice paid",
                "body" => "This is to notify you that the invoice for the project ".$project_name." in the amount NGN".$invoice->amount." has been paid",
                "action" => [
                    "text" => "View invoices",
                    "url" => "/invoices"
                ]
            ]));
            return "Thanks, ".$user->name." has successfully recived the payment";
        }else{
            return $data['reason'];
        }
    }

    public function view($invoice_id){
        $invoice = Invoice::where(['id'=>$invoice_id, 'project_id' => Auth::user()->id])->first();
        return $invoice->count() > 0 ? $this->SUCCESS('Invoice retrieved', $invoice) : $this->SUCCESS('No invoice found');
    }
}
