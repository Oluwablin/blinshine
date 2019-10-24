<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Auth\Events\Registered;
use App\User;
use App\Project;
use App\Estimate;
use App\Invoice;
use Response;
use Hash;
Use Validator;
use Session;
use Redirect;
use Carbon\Carbon;
use App\Client;
use App\State;
use App\Country;
use App\Currency;
use Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Estimate as EstimateResource;
use App\Http\Resources\EstimateCollection;
use App\Profile;
use App\Subscription;
use Illuminate\Foundation\Auth\RegistersUsers;


class GuestController extends Controller
{

    // public $project;

    public function step1(Request $request)
    {
        $project = $request->session()->get('project');
        
        if(!$project)
        {
        return view('guests/step1');
        }

        // return view('guests/step1',compact('project', $project));
        return view('guests/step1');
        
       
    }

    public function createstep1(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

       

        

        if ($validator->fails()) 
        {
            return back()->withErrors($validator)->withInput();
        } 
        else 
        {

            $data = ["title"=> $request->title,
            "description"=> $request->description,
            'tracking_code' => Project::generateTrackingCode()
        ];

        if(empty($request->session()->get('project'))){
            $request->session()->put('project',  $data);
        }else{
            $project = $request->session()->get('project');
            $request->session()->put('project',  $data);
        }

        return redirect('guest/create/step2/');

                // dd(session('project'));
            
        }

    }

    public function createstep2(Request $request)
    {
        $data = session('project');
        $currencies = Currency::all('id', 'code');

        if ($data) {
            $project = Session::get('project');
            $request->session()->put('project', $project);
            return view('guests/step2')->with(['project' => $project, 'currencies' => $currencies]);
           
        }

        return redirect('guest/create/step1/')->with("error", "You need to create a project first");

     
    }



    public function savestep2(Request $request)
    {

         $project = Session::get('project');
        $request->session()->put('project', $project);
       
        // $validator = Validator::make($request->all(), [
        //     // 'project_id' => 'required|numeric',
        //     'time' => 'required|numeric',
        //     'price_per_hour' => 'required|numeric',
        //     'equipment_cost' => 'nullable|numeric',
        //     'sub_contractors' => 'nullable|string',
        //     'sub_contractors_cost' => 'nullable|numeric',
        //     'similar_projects' => 'required|numeric',
        //     'rating' => 'required|numeric',
        //     'currency_id' => 'required',
        //     'start' => 'required|date',
        //     'end' => 'required|date'
        // ]);

        

        // if ($validator->fails()) {
        //     return back()->withErrors($validator)->withInput();
        // } else {
            $data = [
                'time' => $request->time,
                'price_per_hour' => $request->cost_per_hour,
                'equipment_cost' => $request->equipment_cost,
                'sub_contractors' => $request->sub_contractors,
                'sub_contractors_cost' => $request->sub_contractors_cost,
                'similar_projects' => $request->similar_projects,
                'rating' => $request->rating,
                'currency_id' => $request->currency_id,
                'start' => $request->start,
                'end' => $request->end
        ];
           

        $request->session()->put('estmate', $data);

            // $ddata = Session::all();
            //  dd($data);
            return redirect('guest/create/step3');
        // }

    }

    public function createstep3(Request $request)
    {
        $data = session('project');
        $countries = Country::all('id', 'name');
        $states = State::all('id', 'name');

        if ($data) {
            $estimate = Session::get('estimate');
            $project = Session::get('project');
            $request->session()->put('project', $project);
            $request->session()->put('estmate', $estimate);
            return view('guests/step4')->with(['project' => $project,'estimate' => $estimate,
             'countries' => $countries, 'states' => $states]);
           
        }

        return redirect('guest/create/step1/')->with("error", "You need to create a project first");

    }

        public function savestep3(Request $request){
            $contacts = [];
            if($request->contact){
                foreach($request->contact as $contact){
                    array_push($contacts, ["name"=>$contact["'name'"], "email"=>$contact["'email'"] ]);
                }
                $contacts = json_encode($contacts);
            }
        $data = [
                'name' => $request->name,
                'email' => $request->email,
                'street' => $request->street,
                'street_number' => $request->street_number,
                'city' => $request->city,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'zipcode' => $request->zipcode,
               ];

               $project = Session::get('project');
               $estimate = Session::get('estimate');
               // session::put(['estimate' =>  $data]);
               $request->session()->put('estimate', $estimate);
               $request->session()->put('project', $project);
               $request->session()->put('client', $data);
               $request->session()->put('contacts', $contacts);
    
           
               return redirect('register');
                
                
                
           
        }

        public function createstep4(Request $request){

           return view('guests/register');
        }

        public function savestep4(Request $request){
            $session_project = $request->session()->get('project');
            $session_client = $request->session()->get('client');
            $session_contacts = $request->session()->get('contacts');
            $session_estimate = $request->session()->get('estimate');

            Validator::make($request->all, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            if($user->save){
                $project = new Project;
                $project->title =  $session_project->title;
                $project->save();

                if($session_contacts){
                    foreach($session_contacts as $contact){
                        array_push($session_contacts, ["name"=>$contact["'name'"], "email"=>$contact["'email'"] ]);
                    }
                    $contacts = json_encode($contacts);
                }
                
                    $client = new Client;
                    $client->user_id = $user->id;
                    $client->name = $session_client->name;
                    $client->email = $session_client->email;
                    $client->street = $session_client->street;
                    $client->street_number = $session_client->street_number;
                    $client->city = $session_client->city;
                    $client->country_id = $session_client->country_id;
                    $client->state_id = $session_client->state_id;
                    $client->zipcode = $session_client->zipcode;
                    if(gettype($contacts) == 'string'){
                        $client->contacts = $contacts;
                    };

                    $invoice = Invoice::create([
                        'project_id' => $project->id,
                        'issue_date' => $data['issued_date'],
                        'due_date' => $data['due'],
                        'amount' => $data['total'],
                        'estimate_id' =>  $estimate->id,
                        'amount_paid' =>  0,
                        'currency_id' => session('estimate')['currency_id'],
                        'status' => 'unpaid'
                    ]);
            }
           
    
         }

     
}
