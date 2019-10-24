@extends('layouts.auth')





@section('main-content')
                 <style>
     .create-estimate {
            font-family: Ubuntu;
            width: 13rem;
            height: 3.5rem;
            background: #0ABAB5;
            color: white;
            border: none;
            font-size: 20px;
            text-align: center;
            margin-left: 40px;
            margin-top: 40px;
            margin-bottom: 20px;
        }
        .content h3 {
            font-family: Ubuntu;
            font-style: normal;
            font-weight: 500;
            font-size: 22px;
            line-height: 32px;
            color: #262626;
            margin-left: 40px;
            margin-bottom: 20px;
        }
        .content p {
            font-weight: normal;
            font-size: 14px;
            line-height: 20px;
            color: #091429;
            margin-left: 40px;
        }

    @media(max-width: 850px) {
        main {
                margin-left: 0 !important;
                margin-top: 2.5rem;
            }
        }

     @media(max-width: 750px) {
            .main-container {
                width: auto !important;
            }
     }


 </style>
        <main>
            <!-- Main body -->
            <div class="container main-container">

                <div class="content">
                    <button onclick="window.location.assign('/estimate/create/step1')" class='create-estimate'>Create Estimate</button>
                    <h3>Estimates helps you place value to your work and time!</h3>
                    <p>Create an estimate and easily convert it to an invoice and send to your client.</p>
                </div>

            </div>

        </main>

@endsection
