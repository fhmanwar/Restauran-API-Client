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

	<div id="page">

        <nav class="colorlib-nav" role="navigation">
            <div class="top-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-2">
                            <div id="colorlib-logo"><a href="{{ route('home') }}">Piezo Coffee</a></div>
                        </div>
                        <div class="col-xs-10 text-right menu-1">
                            <ul>
                                <li><a href="{{ route('home') }}">Beranda</a></li>
                                {{-- <li><a href="{{ route('cart/'.session()) }}"><i class="icon-shopping-cart"></i> Cart </a></li> --}}
                                <li><a href="{{ url('cart/'.session('noMeja')) }}"><i class="icon-shopping-cart"></i> Keranjang </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        @php
            $image = 'cover-img-1.jpg'
        @endphp
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

        <div id="colorlib-subscribe">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2></i>Piezo Coffee</h2>
                    </div>
                </div>
            </div>
        </div>

        <footer id="colorlib-footer" role="contentinfo">
            <div class="container">
                <div class="row row-pb-md">
                    <div class="col-md-3 colorlib-widget">
                        <h4>About Store</h4>
                        <p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
                        <p>
                            <ul class="colorlib-social-icons">
                                <li><a href="#"><i class="icon-twitter"></i></a></li>
                                <li><a href="#"><i class="icon-facebook"></i></a></li>
                                <li><a href="#"><i class="icon-linkedin"></i></a></li>
                                <li><a href="#"><i class="icon-dribbble"></i></a></li>
                            </ul>
                        </p>
                    </div>
                    <div class="col-md-2 colorlib-widget">
                        <h4>Customer Care</h4>
                        <p>
                            <ul class="colorlib-footer-links">
                                <li><a href="#">Contact</a></li>
                                <li><a href="#">Returns/Exchange</a></li>
                                <li><a href="#">Gift Voucher</a></li>
                                <li><a href="#">Wishlist</a></li>
                                <li><a href="#">Special</a></li>
                                <li><a href="#">Customer Services</a></li>
                                <li><a href="#">Site maps</a></li>
                            </ul>
                        </p>
                    </div>
                    <div class="col-md-2 colorlib-widget">
                        <h4>Information</h4>
                        <p>
                            <ul class="colorlib-footer-links">
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Delivery Information</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Support</a></li>
                                <li><a href="#">Order Tracking</a></li>
                            </ul>
                        </p>
                    </div>

                    <div class="col-md-2">
                        <h4>News</h4>
                        <ul class="colorlib-footer-links">
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="#">Press</a></li>
                            <li><a href="#">Exhibitions</a></li>
                        </ul>
                    </div>

                    <div class="col-md-3">
                        <h4>Contact Information</h4>
                        <ul class="colorlib-footer-links">
                            <li>291 South 21th Street, <br> Suite 721 New York NY 10016</li>
                            <li><a href="tel://1234567920">+ 1235 2355 98</a></li>
                            <li><a href="mailto:info@yoursite.com">info@yoursite.com</a></li>
                            <li><a href="#">yoursite.com</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="copy">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p>
                            <span class="block">
                                Copyright &copy;2021 Restaurant Self Service by Piezo
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </footer>

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

