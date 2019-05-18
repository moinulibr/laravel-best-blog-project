<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')-{{ config('app.name', 'Laravel') }}</title>
    
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <!--Toastr Css--->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css"
	        rel="stylesheet" />


        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    
        <!-- Bootstrap Core Css -->
        <link href="{{ asset('assets/backend/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    
        <!-- Waves Effect Css -->
        <link href="{{ asset('assets/backend/plugins/node-waves/waves.css') }}" rel="stylesheet" />
    
        <!-- Animation Css -->
        <link href="{{ asset('assets/backend/plugins/animate-css/animate.css') }}" rel="stylesheet" />
    
        <!-- Morris Chart Css-->
        <link href="{{ asset('assets/backend/plugins/morrisjs/morris.css') }}" rel="stylesheet" />
    
        <!-- Custom Css -->
        <link href="{{ asset('assets/backend/css/style.css') }}" rel="stylesheet">
    
        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="{{ asset('assets/backend/css/themes/all-themes.css') }}" rel="stylesheet" />

        <!--Sweet Alert--->
      <!----- Sweet alert-------->
		<!---For Producetion Mode--->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	{{-- -<!----- Sweet alert-------->
		<!---For Producetion Mode--->
	<script src="sweet-alert-js/sweetalert.min.js" ></script> --}}

    @stack('css')
</head>
<body class="theme-blue">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    @include('layouts.backend.partials.topbar')
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
    @include('layouts.backend.partials.left')
        <!-- #END# Left Sidebar -->
    </section>

    <section class="content">
        @yield('content')
    </section>


 <!-- Jquery Core Js -->
 <script src="{{ asset('assets/backend/plugins/jquery/jquery.min.js') }}"></script>

 <!-- Bootstrap Core Js -->
 <script src="{{ asset('assets/backend/plugins/bootstrap/js/bootstrap.js') }}"></script>

 <!-- Select Plugin Js -->
 <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

 <!-- Slimscroll Plugin Js -->
 <script src="{{ asset('assets/backend/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

 <!-- Waves Effect Plugin Js -->
 <script src="{{ asset('assets/backend/plugins/node-waves/waves.js') }}"></script>


 <!-- Custom Js -->
 <script src="{{ asset('assets/backend/js/admin.js') }}"></script>
 

 <!-- Demo Js -->
 <script src="{{ asset('assets/backend/js/demo.js') }}"></script>

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

<script> 
		// this is right code..below
		$(document).on("click","#delete", function(e){
		e.preventDefault();
		var link = $(this).attr("href");
		swal({
		  title: "Are you sure want to Delete this?",
		  text: "Once deleted, This will be Permanently Delete!",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		  if (willDelete) {
			window.location.href = link;
		  } else {
			swal("Your Data  is safe!");
		  }
		});
		});
	</script>
@stack('js')

</body>
</html>
