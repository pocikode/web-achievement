<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	{{-- Font --}}
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}">

	<link rel="stylesheet" href="{{ asset('bootstrap-4.1.3/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('css/activity.css') }}">

	<title>Activity</title>
</head>
<body>
	@include('navbar')
	
	@yield('header')

	<div class="container-fluid">
		@yield('main')
	</div>

	<footer class="fixed-bottom">
	    <div class="copyright py-3 text-center text-white">
	      	<div class="container">
	        	<small>Copyright &copy; Agus Supriyatna 2018</small>
	      	</div>
	    </div>
	</footer>
	
	{{-- JavaScript --}}
	<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('js/popper.min.js') }}"></script>
	<script src="{{ asset('bootstrap-4.1.3/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/freelancer.min.js') }}"></script>
</body>
</html>