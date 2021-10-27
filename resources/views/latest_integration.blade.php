@extends('layouts.main') 
@section('content')
<section class="banner-static" id="banner">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-12">
						<div class="banner-content">
							<h3>Designed & Worked by the Latest Integration</h3>		
					<p>As a part of the application, Kinney pay has multiple integrations, such as 2-Step verification, Wallet and Cryptocurrency integration with a decentralized server</p>
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
        <div class="col-lg-6 col-md-12">
			<div class="banner-content">
				<h3>Our integrations include</h3>
            </div>
        </div>
			<div class="col-md-12">
				<div class="feature-style-content">
                <ol>
                    <li><b>EASE OF ACCESS -</b> Wallet makes it easy for you to securely store, send and receive Cryptocurrency</li>
                    <li><b>ONE ACCOUNT, MULTIPLE DEVICES -</b> Manage your wallet on multiple devices without giving up control</li>
                    <li><b>SERVERS -</b> The servers are decentralized and redundant. Your wallet is never down. </li>
                    <li><b>SECURE WITH PIN AND PASSWORD -</b> TSecure your wallet with a PIN</li>
                    <li><b>SECURE ELEMENT TECHNOLOGY -</b> You remain in control of your private keys, which are stored only on your device using Secure Element technology. </li>
                    <li><b>MANAGE ADDRESS BOOK -</b> Address book for commonly used addresses/accounts/beneficiaries </li>
                    <li><b>QR CODE AND SCANNER -</b> QR Code for easy payment and QR code reader to connect with other accounts easily </li>
                    <li><b>TRANSACTION MANAGEMENT  -</b> Transaction history with full transaction details. </li>
                    <li><b>PRIVATE KEYS  -</b> Your private keys are encrypted and never leave your device.  </li>
                    <li><b>CRYPTO CURRENCY MANAGEMENT -</b> See the current price of assets in your wallet in your local currency </li>
                    <li><b>ONLY USER ACCESS CURRENCY -</b> We never have access to your funds </li>
                    <li><b>DECENTRALIZED SERVERS -</b> Access to Web Decentralized Servers. Your wallet is never down </li>
                    <li><b>CRYPTO PAYMENTS -</b> Send cryptocurrency payments to anyone, anywhere in the world. </li>
                    <li><b>SECURE USER-CONTROLLED CRYPTO WALLET -</b> securely store, send and receive cryptocurrency.</li>
                </ol> 
               </div><!-- /.feature-style-content -->
			</div><!-- /.col-md-6 -->	
			
		</div><!-- /.row -->
	</div><!-- /.container -->
</section><!-- /.features-style-one -->

@endsection