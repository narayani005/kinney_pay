@extends('layouts.main') 
@section('content')
<section class="banner-static" id="banner">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-12">
						<div class="banner-content">
							<h3>Different features / properties of a Cryptocurrency wallet?</h3>		
					<p>There are dozens of different wallets on the App Store and Google Play, and they all claim they are the best wallet. And every product has its pros and cons. Let’s define some important properties of a true cryptocurrency wallet</p>
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
                   
                <ol>
                    <li><b>A wallet should be lightweight and mobile - </b> Most people would use cryptocurrency on a day-to-day basis to receive money and pay the bills </li>
                    <li><b>It should provide real control over the user's funds, not an imaginary one -</b> There must be the full access to private keys, they must be stored securely and it should be easy to access </li>
                    <li><b>It should be private -</b> The Cryptocurrency’s blockchain is as transparent as a glass. During the time when ‘the big brother is watching you’ we need a special privacy for our transactions like Reusable Payment Codes technology </li>
                    <li><b>A good wallet should not be complicated to use -</b> Not all the users are cryptographers, and they don’t like to see the hash codes and other encodings. The application should be user friendly and easy to use</li>
                    <li><b>It should provide access to useful services -</b>The application should provide services like storing keys, making transactions. In addition to the above, it should also be linked to useful user services </li>
                    <li><b>A wallet should look stylish -</b>Nowadays, users experience pleasure from gadgets and apps. The wallet should be stylish and give a high end feel to use it </li>
                
                </ol> 

                <hr/>
                <p><b> As a general rule, the following fast checks can help you weed out potentially problematic distributions: </b></p>
                <ul>
                    <li>Avoid wallets that need email confirmation. If email is optional, it is probably not a horrible idea.</li>
                    <li> Not every wallet that includes a recovery phrase allows you complete control/access to your funds. Check the architecture again, or consult with different communities about the probable decision.</li>
                    <li>Not every wallet that provides complete access to private keys employs the notion of a mnemonic code (recovery phrase). However, in some circumstances, such as Edge zero-knowledge architecture, it is safe to utilise a wallet that works with login/password. The trade-offs for various options vary.</li>
                    <li>Among wallets that employ mnemonic codes, those with BIP44 protocol support are preferred. You will then be able to simply access your money using wallets from various providers. This is a useful option if you require emergency access to funds on a platform that your preferred wallet does not allow. Although the BIP47 protocol is an extension of the BIP44 protocol, coins sent to a Payment Code address may only be retrieved with a BIP47 compliant wallet.</li>
                    <li>Although open source wallets are desirable, this is not a magical benefit. Unless a user has sufficient expertise to audit a code-base, or the code-base has been audited by well-known and respected organisations or persons, brand reputation is.</li>
                </ul>

                <span>Reference: Medium</span>
                </div><!-- /.feature-style-content -->
			</div><!-- /.col-md-6 -->	
			
		</div><!-- /.row -->
	</div><!-- /.container -->
</section><!-- /.features-style-one -->

@endsection