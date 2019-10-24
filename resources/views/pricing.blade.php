
@extends('layouts.app')

@section('styles')
  <style>
            .navbar-brand{
                font-family: Pacifico;
                color: white
                }
            .navbar-brand h3 span{
                color: #0ABAB5
            }
            .navbar-brand :hover{
                color: rgb(255, 255, 255);
            }

						 /*------Navbar------------*/

			.navbar-main {
			    background-color: #091429;
			}
			.navbar-main .navbar-brand,
			.navbar-main .navbar-text {
			    color: rgba(255, 255, 255, 0.9);
			}
			.navbar-main .navbar-nav .nav-link {
				font-size: 1rem;
			    color: rgba(255, 255, 255, 0.8);
			}
			.navbar-main .nav-item.active .nav-link,
			.navbar-main .nav-item:hover .nav-link {
			    color: #ffffff;
			}

			/* for navbar toggler design */
			.icon-bar {
				width: 22px;
				height: 2px;
				background-color: #B6B6B6;
				display: block;
				transition: all 0.2s;
				margin-top: 4px
			}
			.navbar-toggler {
			  border: none;
			  background: transparent !important;
			}
			.navbar-toggler:focus{
				outline: none !important;
			}

			/* navbar toggler animation*/

			.navbar-toggler .top-bar {
			  transform: rotate(45deg);
			  transform-origin: 10% 10%;
			}
			.navbar-toggler .middle-bar {
			  opacity: 0;
			}
			.navbar-toggler .bottom-bar {
			  transform: rotate(-45deg);
			  transform-origin: 10% 90%;
			}
			.navbar-toggler.collapsed .top-bar {
			  transform: rotate(0);
			}
			.navbar-toggler.collapsed .middle-bar {
			  opacity: 1;
			}
			.navbar-toggler.collapsed .bottom-bar {
			  transform: rotate(0);
			}


            .pricing-header{
                background: #091429
            }

            .pricing-header .nav-link{
            font-size: 15px;
            color: aliceblue;
            }

            .navbar-collapse{
                justify-content: flex-end
            }

            .pricing{
                width: 100%;
                padding-top: 70px;
                padding-left: 20px;
                padding-right: 20px;
                padding: auto;
            }


            .pricing .title-header{
                text-align: center
            }

            .pricing .title-header h1{ 
                font-size: 65px;
                padding-left: 160px;
                padding-right: 160px;
            }
            .pricecol{
                padding-left: 20px !important;
                padding-right: 20px !important;
                margin-top: 20px;
                height: 450px;
                border: 1px solid #000000;
                box-sizing: border-box;
                border-radius: 6px;
                position: relative;
                margin-bottom: 40px;
                width: 95%;
                margin-left: auto;
                margin-right: auto;

            }
            .pricetext{
                text-align: center;
                font-size: 30px;

            }
            .pricenumber{
                text-align: center;
                font-size: 48px;
                
            }

            .price-button{
                width: 100%;
                position: absolute;
                bottom: 2%;
                left:0;
                padding-left: 28px !important;
                padding-right: 28px !important;
            }

            .pricelist{
                list-style: none;
            }
            .pricelist li{
                margin: 5px auto
            }
            .pricelist li span{
                margin: auto 5px
            }

            .button:hover {
                color: white;
            }

            .price-button a{
                color: #fff;
                border: none
            }

            .price-button a{
                background-color: #0ABAB5 ;
            }

            .price-button a:hover{
                background: rgb(9, 155, 150);
            }

            .pricenumber::before{
                font-size: 17px;
                content: '\0024';
                position: relative;
                left: -2px;
                top: -25px
            }

            .pricenumber{
                position: relative;
            }

            .pricenumber p{
                font-size: 17px;
                display: inline;
            }
            article {
                background-color:#091429;
                padding: 25px;
            }

            footer {
                background-color: white;
                padding: 25px;
            }

            .enter-div {
                text-align: center;
                color: white;
                font-weight: normal;
                font-style: normal;
            }

            .enter-div > h6 {
                font-weight: normal;
            }

            #enter-line {
                line-height: 65px;
            }

            #lancer {

            font-style: normal;
            font-weight: normal;
            font-family: 'Pacifico', cursive;
            font-size: 20px;
            }

            #btn-sub {
                background: #0ABAB5;
                border-radius: 4px;
                border-width: 0px;
                color: #FFFFFF;
            }

            #email-input {
                background: #FFFFFF;
                border: 1px solid #C4C4C4;
                box-sizing: border-box;
                border-radius: 2px;
                color: black;
                font-size: 0.8em;
                padding: 5px;
                }

            .btn {
                border: 1px solid #0ABAB5 ;
                color: #0ABAB5;
                box-sizing: border-box;
                border-radius: 6px;
                }

            .link {
                color: black;
            }

            .card {
                background: #FFFFFF;
                border: none;
                width: 350px !important;
                max-width: 350px !important;
                margin-right: auto;
                margin-left: auto;
            }

            ul {
                padding: 0% !important;
            }
            
            #btn-sub:hover {
                background-color: rgb(9, 155, 150);
            }
            
            #navbarNavAltMarkup a:hover {
                color: #0ABAB5 !important;
            }

            span.avoidwrap { display:inline-block; }

            @media only screen and (max-width: 600px) {
                .pricing .title-header h1{
                    font-size: 35px
                }

                .pricecol{
                    margin: 20px auto
                }

            }
      </style>
@endsection

@section('header')
    	<header>
			<nav class="navbar navbar-expand-lg navbar-main">
				<div class="container">
					<a class="navbar-brand" href="#">
						<img src="{{ asset('images/svg/logo-white.svg') }}" class="img img-responsive" height="30" width="auto">
					</a>
					<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar top-bar"></span>
						<span class="icon-bar middle-bar"></span>
						<span class="icon-bar bottom-bar"></span>
						<!-- <span class="navbar-toggler-icon"><i class="fa fa-bars fa-lg py-1 text-white"></i></span> -->
					</button>
					<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
						<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
							<li class="nav-item ">
								<a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
							</li>
							<li class="nav-item active">
								<a class="nav-link " href="{{ url('/pricing') }}">Pricing</a>
							</li>
						<li class="nav-item">
								<a class="nav-link" href="{{ route('login') }}">Sign in</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ route('register') }}">Sign up</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
@stop

@section('sidebar')

@endsection

@section('content')
<section class="pricing">
            <div class="container">
                <div class="title-header">
                    <h1>Choose a plan that works for you</h1>
                </div>
                <div class="row mt-5 pt-5">

                 @if(isset($plans) && $plans != null)

@foreach($plans as $mainPlans)

   <div class="col-lg-4 col-md-6 col-sm-6">
  <div class="pricecol p-2 pt-4">



        <p class="pricetext">{{ str_replace("_"," ",ucfirst($mainPlans['name']))}}</p>

        <div class="price">
        <h5 class="pricenumber">{{ str_replace("_"," ",ucfirst($mainPlans['price']))}}<p>/mo</p></h5>
        </div>

            @if($loop->index == 1)
            <p class="m-0 text-center" style="font-size: 12px">All Starter features and</p>
            @endif

            @if($loop->index == 2)
            <p class="m-0 text-center" style="font-size: 12px">All Starter and Pro features and</p>
            @endif

            @php
            $url = url("/payment/subscription/".$mainPlans['name']);

            @endphp
         @foreach($mainPlans as $key => $value)



                @if(($key != 'id') && ($key != 'created_at') && ($key != 'updated_at'))

                      @if($key == 'features')
                       <ul class="pricelist pt-3">

                              @php

                               $FeaturesArray = $value;
                              @endphp


                                  @foreach($FeaturesArray as $Featureskey => $Featuresvalue)

                                      @php
                                      ($Featuresvalue == true) ? $Featuresvalue = "TRUE" : (($Featuresvalue == false) ? $Featuresvalue = "FALSE" : (($Featuresvalue == null) ? $Featuresvalue = "No" : "Null"));
                                      @endphp

                     <li>
                      <span><svg width="16" height="16" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M21 10.0857V11.0057C20.9988 13.1621 20.3005 15.2604 19.0093 16.9875C17.7182 18.7147 15.9033 19.9782 13.8354 20.5896C11.7674 21.201 9.55726 21.1276 7.53447 20.3803C5.51168 19.633 3.78465 18.2518 2.61096 16.4428C1.43727 14.6338 0.879791 12.4938 1.02168 10.342C1.16356 8.19029 1.99721 6.14205 3.39828 4.5028C4.79935 2.86354 6.69279 1.72111 8.79619 1.24587C10.8996 0.770634 13.1003 0.988061 15.07 1.86572" stroke="#091429" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M21 3.00574L11 13.0157L8 10.0157" stroke="#091429" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg></span> {{ str_replace("_"," ",ucfirst($Featureskey)) }}</li>


                                  @endforeach

                          @endif
                     </ul>



          @endif

                     @if(Auth::user() != null)
                      <div class="price-button p-3">
                      <a class="btn btn-primary btn-block" href='{{$url}}'>Purchase</a>
                      </div>
                      @endif

                      @if(Auth::user() == null)
                      <div class="price-button p-3">
                      <a class="btn btn-primary btn-block" href="/register">Sign up</a>
                      </div>
                      @endif
          @endforeach

            </div>
          </div>

@endforeach


@endif

                </div>
            </div>
        </div>
        </section>
     <article>
<div class="enter-div">
<h4 id="enter-line">Enterprise ready tools</h4>
<h6>with dedicated support and quick and consistent deolverance of new features, you can trust your<br>
process in our able hands</h6>
<br>
<button onclick="window.location.assign('/contact')" type="button" class="btn" >Contact Sales</button>
</div>
</article>

@stop



@section('footer')
    <footer class="bg-white pt-4">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-2">
						<img src="{{ asset('images/svg/logo-dark.svg') }}" alt="" class="img img-responsive mb-2" height="30" width="auto">
						<ul class="list-unstyled">
							<li><a class="text-dark" href="{{ url('/pricing') }}">Pricing</a></li>
							<li><a class="text-dark" href="{{ url('/login') }}">Sign in</a></li>
							<li><a class="text-dark" href="{{ url('/register') }}">Sign up</a></li>
						</ul>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-2">
						<h5>Features</h5>
						<ul class="list-unstyled">
							<li><a class="text-dark" href="{{ url('/dashboard') }}">Dashboard</a></li>
							<li><a class="text-dark" href="{{ url('/projects') }}">Projects</a></li>
							<li><a class="text-dark" href="{{ url('/invoices') }}">Invoices</a></li>
							<li><a class="text-dark" href="{{ url('/guest/create_estimate') }}">Create a Project</a></li>
						</ul>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4">
						<h5>Reach us</h5>
						<p class="text-dark small">
							52b, Charity Lane, off Magboso Highway, Ikate, London, Nigeria
						</p>
						<h5 class="">
							<a href="#" class="text-dark mr-2"><i class="fab fa-facebook-square"></i></a>
							<a href="#" class="text-dark"><i class="fab fa-twitter-square"></i></a>
						</h3>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4">
						<h5>Stay up to date</h5>
						<p class="text-dark small">
							Get emails about our newest features and events you can visit. We promise not to spam.
						</p>
						<form class="form-inline">
							<div class="form-group mb-2 mr-2">
								<label for="staticEmail2" class="sr-only">Email</label>
								<input type="email" class="form-control" id="staticEmail2" value="" placeholder="Email Address" required>
							</div>
							<button type="submit" class="btn btn-secondary mb-2">Subscribe</button>
						</form>
					</div>
				</div>
			</div>
			<div class="bg-white text-left py-2 mt-0">
				<div class="container">
					<p class="float-right">
			    	<a href="#">Back to top</a>
				    </p>
				    <p>&copy; Lancer 2019.</p>
				</div>
			</div>
		</footer>
@stop



