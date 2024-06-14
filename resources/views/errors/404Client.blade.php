<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    
    <link href="{{ asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
	<!-- <link href="{{ asset('public/frontend/css/all.min.css')}}" rel="stylesheet"> -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{('public/frontend/images/favicon.ico')}}">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{('public/frontend/images/apple-touch-icon-144-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{('public/frontend/images/apple-touch-icon-114-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{('public/frontend/images/apple-touch-icon-72-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" href="{{('public/frontend/images/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
	<div class="container text-center">
		<div class="logo-404">
			<a href="{{URL::to('/')}}"><img src="{{URL::to('/public/frontend/images/logo.png')}}" alt="" /></a>
		</div>
		<div class="content-404">
			<img src="{{URL::to('/public/frontend/images/404.png')}}" class="img-responsive" alt="" width="500"/>
			<h1><b>OPPS!</b> Không thể tìm thấy trang</h1>
			<h2><a href="{{URL::to('/')}}">Trở lại Trang Chủ</a></h2>
		</div>
	</div>

  
    <script src="{{ asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{ asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{ asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{ asset('public/frontend/js/price-range.js')}}"></script>
	<script src="{{ asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
	<script src="{{ asset('public/frontend/js/main.js')}}"></script>
	<script src="{{ asset('public/frontend/js/sweetalert.js')}}"></script> <!--Sweet Alert-->
</body>
</html>