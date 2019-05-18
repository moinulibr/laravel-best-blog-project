<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')-{{ config('app.name', 'Laravel') }}</title>
		
		   <!--Toastr Css--->
			 <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css"
			 rel="stylesheet" />

		
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

	<!-- Stylesheets -->
	<link href="{{ asset('assets/frontend/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/frontend/css/swiper.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/frontend/css/ionicons.css') }}" rel="stylesheet">

	
    @stack('css')
</head>
<body>
    
  @include('layouts.frontend.partials.header')

	@yield('content')

@include('layouts.frontend.partials.footer')


	<!-- SCIPTS -->

	<script src="{{ asset('assets/frontend/js/jquery-3.1.1.min.js') }}"></script>

	<script src="{{ asset('assets/frontend/js/tether.min.js') }}"></script>

	<script src="{{ asset('assets/frontend/js/bootstrap.js') }}"></script>

	<script src="{{ asset('assets/frontend/js/swiper.js') }}"></script>

	<script src="{{ asset('assets/frontend/js/scripts.js') }}"></script>

	<!--Toastr js--->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js" > </script>

	<script>
			@if(Session::has('messege'))
			var type = "{{Session::get('alert-type','info')}}"
			switch(type){
					case 'info':
							toastr.info("{{ Session::get('messege') }}");
							break;
 
					case 'success':
							toastr.success("{{ Session::get('messege') }}");
							break;
 
					case 'warning':
							toastr.warning("{{ Session::get('messege') }}");
							break;
 
					case 'error':
							toastr.error("{{ Session::get('messege') }}");
							break;
 
					}
			@endif
	</script>
@stack('js')
  
</body>
</html>
