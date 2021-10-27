@extends('layouts.main') 
@section('content')
<section class="banner-static" id="banner">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-12">
						<div class="banner-content">
							<h3>Responsive Design for All Devices with Quality </h3>		
					<p>Kinney Pay is using the Responsive design (RD) approach, that makes dynamic changes in the appearance of the application with respect to the Screen size and the orientation of the using device.</p>
					<!--a href="#" class="thm-btn"><span>Download App</span></a><a href="#" class="thm-btn borderd"><span>Discover more</span></a-->
			</div><!-- /.banner-content -->
		</div><!-- /.col-md-6 -->
		<div class="col-lg-6 col-md-12">
        <div class="banner-moc-box clearfix">
				<img src="{{ asset('/kinnypay/assets/img/slider-moc-4.png') }}" alt="Awesome Image" class="float-right" />
			</div><!-- /.banner-moc-box -->
		</div><!-- /.col-md-6 -->
	</div><!-- /.row -->
</div><!-- /.container -->
</section><!-- /.banner-static -->
<section class="features-style-one">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="feature-style-content">
                    <p>Kinney Pay alters the web design to fit the application based on the user’s device, which makes the experience more tailored for the user. While doing this, our application also maintains a consistent look and feel across multiple devices. As the famous designer Ethan Marcotte puts it, “flexible container resizes itself”, our Kinney pay follows the same flexible visuals.</p>
                    <p>Our website loads remarkably fast, and the application is never down. More importantly, the look and feel of Kinney Pay is consistent across all the devices, yet manages to tailor the application’s user experience to all the devices. The only difference is the change in call-to action buttons and its illustrations between desktop and mobile devices</p>
                    <p>Kinney pay provides seamless experience across all platforms. The menus get progressively smaller across devices – desktop and laptop computers feature a five-item menu, and the mobile devices offer a hamburger icon</p>
                    <p>Their form fields experience the same change. They’re presented in two columns on desktop and laptop computers and one column on tablets and mobile phones</p>
                </div><!-- /.feature-style-content -->
			</div><!-- /.col-md-6 -->	
			
		</div><!-- /.row -->
	</div><!-- /.container -->
</section><!-- /.features-style-one -->

@endsection