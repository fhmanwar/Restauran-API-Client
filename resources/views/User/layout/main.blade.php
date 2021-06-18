<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Store Template</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

  <!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

	<!-- Animate.css -->
	<link rel="stylesheet" href="{{ asset('/css/plugin/user/animate.css') }}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{ asset('/css/plugin/user/icomoon.css') }}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{ asset('/css/plugin/user/bootstrap.css') }}">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="{{ asset('/css/plugin/user/magnific-popup.css') }}">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="{{ asset('/css/plugin/user/flexslider.css') }}">

	<!-- Owl Carousel -->
	<link rel="stylesheet" href="{{ asset('/css/plugin/user/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/plugin/user/owl.theme.default.min.css') }}">

	<!-- Date Picker -->
	<link rel="stylesheet" href="{{ asset('/css/plugin/user/bootstrap-datepicker.css') }}">
	<!-- Flaticons  -->
	<link rel="stylesheet" href="{{ asset('/fonts/flaticon/font/flaticon.css') }}">

	<!-- Theme style  -->
	<link rel="stylesheet" href="{{ asset('/css/userStyle.css') }}">

	<!-- Modernizr JS -->
	<script src="{{ asset('/js/plugin/user/modernizr-2.6.2.min.js') }}"></script>

	</head>
	<body>

	<div class="colorlib-loader"></div>
        @php
            $image = 'cover-img-1.jpg'
        @endphp
	<div id="page">
        @include('user.layout.navbar')
		<aside id="colorlib-hero" class="breadcrumbs">
			<div class="flexslider">
				<ul class="slides">
			   	{{-- <li style="background-image: url(../img/user/cover-img-1.jpg);"> --}}
			   	<li style="background-image: url(../img/user/{{ $image }});">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
				   				<div class="slider-text-inner text-center">
				   					<h1>Products</h1>
				   					<h2 class="bread">
                                        <span><a href="index.html">Home</a></span>
                                        @yield('page')
                                    </h2>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
		</aside>

		<div class="colorlib-shop">
			<div class="container">
                @yield('content')
			</div>
		</div>

        @include('user.layout.footer')
	</div>


	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>

	<!-- jQuery -->
	<script src="{{ asset('/js/plugin/jquery-3.5.1.min.js') }}"></script>
	<!-- jQuery Easing -->
	<script src="{{ asset('/js/plugin/user/jquery.easing.1.3.js') }}"></script>
	<!-- Bootstrap -->
	<script src="{{ asset('/template/assets/js/core/bootstrap.min.js') }}"></script>
	<!-- Waypoints -->
	<script src="{{ asset('/js/plugin/user/jquery.waypoints.min.js') }}"></script>
	<!-- Flexslider -->
	<script src="{{ asset('/js/plugin/user/jquery.flexslider-min.js') }}"></script>
	<!-- Owl carousel -->
	<script src="{{ asset('/js/plugin/user/owl.carousel.min.js') }}"></script>
	<!-- Magnific Popup -->
	<script src="{{ asset('/js/plugin/user/jquery.magnific-popup.min.js') }}"></script>
	<script src="{{ asset('/js/plugin/user/magnific-popup-options.js') }}"></script>
	<!-- Date Picker -->
	<script src="{{ asset('/js/plugin/user/bootstrap-datepicker.js') }}"></script>
    <!-- Sweet Alert -->
    <script src="{{ url('js/plugin/sweetalert2@9.js') }}"></script>
	<!-- Main -->
	<script src="{{ asset('/js/userMain.js') }}"></script>

    @yield('script')
	</body>
</html>

