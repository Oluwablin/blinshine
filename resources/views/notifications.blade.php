@extends('layouts.auth')

@push('styles')
<style>
.user {
	width: 50px;
	height: 50px;
	background-color: #FFFFFF;
	color: #000000;
	border: 1px solid;
	border-radius: 50px;
	text-align: center;
	padding: 15px 15px;
	margin: 7px;
	text-decoration: none;
	
}
h1 {
	font-family: sans-serif;
	font-style: normal;
	font-weight: bold;
	font-size: 18px;
	margin-bottom: 20px;
	margin-top: 24px;
    margin-left: 30px;
}
.notification-box img {
	margin: 10px;
	margin-left: 20px;
	margin-right: -10px;
    padding: 14px;
}
.notification-box {
	border: 1px solid #C4C4C4;
	margin-bottom: 15px;
	margin-right: 20px;
    margin-left: 30px;
    border-radius: 5px;
}
b {
	font-family: sans-serif;
	font-style: normal;
	font-weight: bold;
	font-size: 14px;
	
}
span {
	font-family: sans-serif;
	font-style: normal;
	font-weight: normal;
	font-size: 14px;
	line-height: 2
}
p {
	font-family: sans-serif;
	font-style: normal;
	font-weight: normal;
	font-size: 12px;
	margin-bottom: 0px;
}
</style>
@endpush


@section('main-content')


<h1>NOTIFICATIONS</h1>

@foreach($notifications as $key => $notification)
	<div class="notification-box">
	    <div class="d-flex bd-highlight">
	        <div class="p-2 flex-shrink-1 bd-highlight">
	            <img src="https://res.cloudinary.com/ros4eva/image/upload/v1570747847/{{$key%2 == 0 ?'Vector3_gicch8' : 'Vector_c4lyp5'}}.png">
	        </div>
	        <div class="p-2 w-100 bd-highlight">
	            <b>{{$notification->data['subject']}}</b><br>
	            <span>{{$notification->data['body']}}</span>
	            <p>{{prettyDate($notification->created_at)}}</p>
	        </div>
	    </div>
	</div>
@endforeach
@endsection


@section('others')
    <button class="btn btn-secondary text-white rounded-circle" id="add-something">
        <i class="fas fa-plus"></i>
    </button>
@endsection