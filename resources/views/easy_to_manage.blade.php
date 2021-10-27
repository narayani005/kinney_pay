
	@extends('layouts.main')
	@section('content')

	<section class="banner-static" id="banner">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-12">
						<div class="banner-content">
							<h3>Easy to Manage Your <br/> All Data  by This App</h3>
							<p>Kinney pay allows you to take control of your spending and on your wallet. Use the dashboard screen to track how much amount you have used and get the wallet balance. You can also see the number of beneficiaries and the account transaction history. Never lose control of your wallet, always monitor the debit and credit transactions </p>
							<br/>
							<a href="https://play.google.com/store/apps/details?id=com.kinneypay.wallet" target="_blank" class="thm-btn"><span>Download App</span></a>
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

<section class="how-app-work-section" id="how-it-works">
	<div class="container">
		
		<div class="row">
			<div class="col-md-6 how-app-work-slider-content">			
				<img src="{{ asset('/kinnypay/assets/img/circle.png') }}" class="circled-img" alt="Awesome Image"/>
				<div class="how-app-work-slider-wrapper">
					<div class="how-app-work-screen-mobile-image"></div>
					<!--Slider-->
					<ul class="slider">
						
						<li class="slide-item">
							<img src="{{ asset('/kinnypay/assets/img/slide1.jpg') }}" alt="Awesome Image"/>
						</li>
						<li class="slide-item">
							<img src="{{ asset('/kinnypay/assets/img/slide2.jpg') }}" alt="Awesome Image"/>
						</li>
						<li class="slide-item">
							<img src="{{ asset('/kinnypay/assets/img/slide4.jpg') }}" alt="Awesome Image"/>
						</li>
					</ul>
				</div><!-- /.how-app-work-slider-wrapper -->

			</div><!-- /.col-md-6 -->
			<div class="col-md-6">
				<div class="how-app-work-content-wrap">
					<div class="title">
						<h3> How easy to use</h3>

						<p class="pt-2">Kinney pay has a beautiful, easy to use and handle wallet that puts you in control of your wealth. Manage your wealth in the cryptocurrency wallet that combines beautiful design and solid engineering in the form of charts and graphs that update in real-time.

The dashboard shows,</p>
					</div><!-- /.title -->
					<div class="how-app-work-content" id="how-app-work-slider-pager">
						<a href="#" class="pager-item" data-slide-index="0"><div class="single-how-app-work">
							<div class="icon-box">
								<div class="inner">
								<i class="fas fa-wallet"></i>
								</div><!-- /.inner -->
							</div><!-- /.icon-box -->
							<div class="text-box">
								<h4>the Wallet</h4>
							</div><!-- /.text-box -->
						</div></a><!-- /.single-how-app-work -->
						<a href="#" class="pager-item active" data-slide-index="1"><div class="single-how-app-work ">
							<div class="icon-box">
								<div class="inner">
								<i class="fas fa-users"></i>
								</div><!-- /.inner -->
							</div><!-- /.icon-box -->
							<div class="text-box">
								<h4>the Beneficiary</h4>
							</div><!-- /.text-box -->
						</div></a><!-- /.single-how-app-work -->
						
						<a href="#" class="pager-item" data-slide-index="2"><div class="single-how-app-work ">
							<div class="icon-box">
								<div class="inner">
								<i class="fas fa-chart-pie"></i>
								</div><!-- /.inner -->
							</div><!-- /.icon-box -->
							<div class="text-box">
								<h4>the History of transactions. </h4>
							</div><!-- /.text-box -->
						</div></a><!-- /.single-how-app-work -->
					</div><!-- /.how-app-work-content -->
					<a href="https://play.google.com/store/apps/details?id=com.kinneypay.wallet" target="_blank" class="download-btn active">
						<i class="fab fa-apple"></i>
						<span class="inner"> <span class="avail">Available on</span> <span class="store-name">App Store</span></span>
					</a>
					<a href="https://play.google.com/store/apps/details?id=com.kinneypay.wallet" target="_blank" class="download-btn">
						<i class="fab fa-google-play"></i>
						<span class="inner"><span class="avail">Available on</span> <span class="store-name">Google play</span></span>
					</a>
				</div><!-- /.how-app-work-content-wrap -->
			</div><!-- /.col-md-6 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</section><!-- /.how-app-work-section -->

<div class="separator no-border mt135 full-width"></div><!-- /.separator no-border mt135 -->

<section class="features-style-one">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="feature-style-content">
					<!--i class="flaticon-tools"></i-->
					<!--h3>Easy to Manage Your All Data <br /> by This App</h3-->
					<p class="pr-4">The chart shows the spending on a daily basis, which shows the highest and the lowest spending on a week and on a monthly basis</p>
					<p> You can add the list of beneficiaries and manage them within the application. Beneficiaries can be added with the Mobile numbers registered in the application.  </p>
					<p> <b>Beneficiaries can be from the countries </b> </p>
					<div class="row">
						<div class="col-md-2"> <img src="{{asset('/assets/images/india.png')}}" width="40px" height="40px">   </div>
						<div class="col-md-2"> <img src="{{asset('/assets/images/malaysia.png')}}" width="40px" height="40px">  </div>
						<div class="col-md-2"> <img src="{{asset('/assets/images/philippines.png')}}" width="40px" height="40px">  </div> 
					</div>
				</div><!-- /.feature-style-content -->
			</div><!-- /.col-md-6 -->	
			<div class="col-md-6">
				<img src="{{ asset('/kinnypay/assets/img/dash.png') }}" class="has-dropshadow" style="width:100%!important;height:auto" alt="Awesome Image"/>
			</div><!-- /.col-md-6 -->
			<div class="col-md-12 pt-4">
			<p>From the Wallet, you can send cryptocurrency to yourself and can send cryptocurrency to others. The accounts can be either </p>
			<div class="row">
				<div class="col-md-2"> <b>Kinney VPO</b> </div>
				<div class="col-md-1"> OR </div>
				<div class="col-md-2"> <b>Kinney Plus</b> </div>
			</div>
<br/>
 

<p>The transaction history of sending and receiving the currency will be listed in the ‘Transaction History’ tab. The transaction history from the beginning of the account is maintained in the servers.</p>

 

<p>Acknowledged to be the best but, just also the fanciest. Kinney Pay is being adapted for use by the masses and across multiple countries assuring it one of the easiest applications to use in cryptocurrency application.</p>


			</div>
		</div><!-- /.row -->
	</div><!-- /.container -->
</section><!-- /.features-style-one -->

<div class="separator no-border mt135 full-width"></div><!-- /.separator no-border mt135 -->

@endsection