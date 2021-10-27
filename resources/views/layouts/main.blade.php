<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Kinney Pay</title>
	<!-- mobile responsive meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('/kinnypay/assets/img/favicon/android-icon-192x192.png') }}">
	<link rel="manifest" href="{{ asset('/kinnypay/assets/img/favicon/manifest.json') }}">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="../ms-icon-144x144.html">
	<meta name="theme-color" content="#ffffff">
    <link href="{{ asset('/kinnypay/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/kinnypay/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>

	<div class="preloader"><div class="spinner"></div></div><!-- /.preloader -->

	<header class="header home-page-one">
		<div class="container">
			<div class="appilo-menu clearfix">
				<nav class="navbar navbar-expand-lg navbar-custom navbar-light">

					<a class="navbar-brand  mr-auto " href="#">
						<img src="{{ asset('/kinnypay/assets/img/paylogo.png') }}" alt="Kinney Infotech Logo" class="default-logo">
						<img src="{{ asset('/kinnypay/assets/img/wlogo.png') }}" alt="Kinney Infotech Logo" class="stick-logo">
					</a>

					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
						<i class="fas fa-bars"></i>
					</button>

					<div class="collapse navbar-collapse navbar-nav" id="navbarToggler">
						<ul class="ml-auto">
							<li><a class="nav-link active" href="#banner">Home</a></li>
							<li><a class="nav-link" href="#features">Features</a></li>
							<li><a class="nav-link" href="#how-it-works">How It Works</a></li>
							<li><a class="nav-link" href="#pricing">Pricing</a></li>
							<li class="dropdown">
								<a class="nav-link" href="#blog">
									Blog
								</a>
							</li>
						</ul>
					</div>
					<div class="sign-up-btn">
						<a href="{{ url('/login') }}" class="sign-btn">Login</a>
					</div>
				</nav>
			</div>
		</header><!-- /.header -->

        @yield('content')

        <div class="separator no-border mb135 full-width"></div><!-- /.separator no-border mb135 -->
<footer class="footer">
	<div class="subscribe-section">
		<div class="container">
			<div class="sec-title text-center">
				<h2>Subscribe to Our Newsletter</h2>
				<p>A Private Limited is the most popular type of partnership Malta. The limited liability <br /> is, in fact, the only type of company allowed by Companies.</p>
			</div><!-- /.sec-title -->
			<form action="#" class="subscribe-form clearfix">
				<div class="left-content float-left clearfix">
					<i class="far fa-envelope"></i>
					<input type="text" placeholder="support@kinneypay.com" />
				</div><!-- /.left-content -->
				<div class="right-content float-right">
					<button class="thm-btn" type="submit"><span>Subscribe Now</span></button>
				</div><!-- /.right-content -->
			</form><!-- /.subscribe-form -->
		</div><!-- /.container -->
	</div><!-- /.subscribe-section -->
	<div class="footer-widget-wrapper">
		<div class="container">
			<div class="row masonary-layout">
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="footer-widget about-widget">
						<a href="#"><img style="width:50%" src="{{ asset('/kinnypay/assets/img/flogo.png') }}" alt="Awesome Image"/></a>
						<p>Be the first to find out about exclusive deals, the latest Lookbooks trends. We're on a mission to build a better future where technology.</p>
						<div class="social">
							<a href="#" class="fab fa-facebook-f"></a><!--
							--><a href="#" class="fab fa-twitter"></a><!--
							--><a href="#" class="fab fa-google-plus-g"></a><!--
						--><a href="#" class="fab fa-instagram"></a>
					</div><!-- /.social -->
				</div><!-- /.footer-widget -->
			</div><!-- /.col-md-3 -->
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="footer-widget contact-widget">
					<div class="title">
						<h3>Address</h3>
					</div><!-- /.title -->
					<p><span>Phone:</span> +63-9164677937</p>
					<p><span>Email:</span> support@kinneypay.com</p>
					<p><span>Address:</span> UCO Bank, 2nd Floor, <br /> High School Square, Red Cross Road, <br/> Bhanjanagar, Odisha - 761 126. <br/> India</p>
				</div><!-- /.footer-widget -->
			</div><!-- /.col-md-3 -->
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="footer-widget links-widget">
					<div class="title">
						<h3>Quick Links</h3>
					</div><!-- /.title -->
					<ul class="list-inline link-list">
                                <li><a href="{{url('/')}}">Home</a></li><!--
							--><li><a href="{{url('/#features')}}">Features</a></li><!--
							--><li><a href="{{url('/#how-it-works')}}">How it works</a></li><!--
							--><li><a href="{{url('/#pricing')}}">Pricing</a></li><!--
							--><li><a href="{{url('/#blog')}}">Blogs</a></li><!--
							--><li><a href="{{url('/login')}}">Login</a></li><!--
							--><li><a href="{{url('/contact_us')}}" target="_blank">Contact</a></li><!--
							--><li><a href="{{url('/sitemap')}}">Roadmap</a></li>
							<!--li><a href="#">Teams</a></li>
							<li><a href="#">FAQ</a></li-->
					</ul><!-- /.link-list -->
				</div><!-- /.footer-widget -->
			</div><!-- /.col-md-3 -->
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="footer-widget tweets-widget">
					<div class="title">
						<h3>Tweets</h3>
					</div><!-- /.title -->
					<div class="tweets-carousel owl-theme owl-carousel">
						<div class="item">
							<div class="single-tweet">
								<p><i class="fab fa-twitter"></i>Lorem ipsum dolor sit amet, con sectetur adipiscing elit, sed do eius mod tempor incididunt.</p>
							</div><!-- /.single-tweet -->
						</div><!-- /.item -->
						<div class="item">
							<div class="single-tweet">
								<p><i class="fab fa-twitter"></i>Lorem ipsum dolor sit amet, con sectetur adipiscing elit, sed do eius mod tempor incididunt.</p>
							</div><!-- /.single-tweet -->
						</div><!-- /.item -->
						<div class="item">
							<div class="single-tweet">
								<p><i class="fab fa-twitter"></i>Lorem ipsum dolor sit amet, con sectetur adipiscing elit, sed do eius mod tempor incididunt.</p>
							</div><!-- /.single-tweet -->
						</div><!-- /.item -->
						<div class="item">
							<div class="single-tweet">
								<p><i class="fab fa-twitter"></i>Lorem ipsum dolor sit amet, con sectetur adipiscing elit, sed do eius mod tempor incididunt.</p>
							</div><!-- /.single-tweet -->
						</div><!-- /.item -->
					</div><!-- /.tweets-carousel -->
				</div><!-- /.footer-widget -->
			</div><!-- /.col-md-3 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /.footer-widget-wrapper -->
<div class="footer-bottom" id="footer-id">
	<div class="container">
		<div class="footer-copyright">
			<div class="float-left left-content">
				<p>© 2021, Kinney Pay Powered by Kinney Infotech <!--span class="sep">|</span> <a href="#">Privacy Policy</a--> <span class="sep">|</span> <a href="{{url('/sitemap')}}">Sitemap</a></p>
			</div><!-- /.float-left left-content -->
			<div class="float-right right-content">
				<p>All Rights Reserved.</p>
			</div><!-- /.float-right -->
		</div>
	</div><!-- /.container -->
</div><!-- /.footer-bottom -->
</footer><!-- /.footer -->

<div class="scrollup"><span class="fas fa-angle-up"></span></div>

<script src="{{ asset('/kinnypay/assets/js/jquery.js')}}"></script>

<script src="{{ asset('/kinnypay/assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('/kinnypay/assets/js/popper.min.js')}}"></script>
<script src="{{ asset('/kinnypay/assets/js/bootstrap-select.min.js')}}"></script>
<script src="{{ asset('/kinnypay/assets/js/jquery.validate.min.js')}}"></script>
<script src="{{ asset('/kinnypay/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('/kinnypay/assets/js/isotope.js')}}"></script>
<script src="{{ asset('/kinnypay/assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{ asset('/kinnypay/assets/js/waypoints.min.js')}}"></script>
<script src="{{ asset('/kinnypay/assets/js/jquery.counterup.min.js')}}"></script>
<script src="{{ asset('/kinnypay/assets/js/wow.min.js')}}"></script>
<script src="{{ asset('/kinnypay/assets/js/jquery.easing.min.js')}}"></script>
<script src="{{ asset('/kinnypay/assets/js/swiper.min.js')}}"></script>
<script src="{{ asset('/kinnypay/assets/js/jquery.bxslider.min.js')}}"></script>
<script src="{{ asset('/kinnypay/assets/js/custom.js')}}"></script>

</body>
</html>