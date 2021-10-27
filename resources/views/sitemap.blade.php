@extends('layouts.main')
@section('content')

<section class="banner-static" id="banner">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-12">
						<div class="banner-content">
							<h3>Sitemap </h3>
                            <div><span> <a href="{{url('/')}}">Home</a></span></div>
                            <div><span> <a href="{{url('/#features')}}">Features</a></span></div>
                            <div><span> <a href="{{url('/#how-it-works')}}">How it works</a></span></div>
                            <div><span> <a href="{{url('/#pricing')}}">Pricing</a></span></div>
                            <div><span> <a href="{{url('/#blog')}}">Blogs</a></span></div>
                            <div><span> <a href="{{url('/contact_us')}}">Contact</a></span></div>
                            <div><span> <a href="{{url('/login')}}">Login</a></span></div>
                            <div><span> <a href="{{url('/sitemap')}}">Roadmap</a></span></div>
                           
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
@endsection