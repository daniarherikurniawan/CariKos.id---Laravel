<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
	<title>Cari Kos</title>
	<link href='http://fonts.googleapis.com/css?family=Raleway:400,200,600,800,700,500,300,100,900' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Arimo:400,700,700italic' rel='stylesheet' type='text/css'>
	<link href="{{asset('css/bootstrap.css')}}" rel='stylesheet' type='text/css'/>
	<link href="{{asset('css/inspector-stylesheet.css')}}" rel='stylesheet' type='text/css'/>
	<link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="{{asset('js/jquery.min.js')}}"></script>
</head>
<body>
	<!--topheader starts-->	 
	<div class="strip  navbar-fixed-top navbar">
		<div class="top-menu">
			<span class="menu"> </span>
			<ul>
				<li <?php if(\Session::get('active')=="Home"){ echo "class=\"active\"";} ?>><a href="redirecthome">Home</a></li>
				<li  <?php if(\Session::get('active')=="Daftar Tempat Kos"){ echo "class=\"active\"";} ?>><a href="listkosan">Daftar Tempat Kos</a></li>
				<li></li>
				<?php if(\Session::has('id')){ ?>
				<li  <?php if(\Session::get('active')=="Kelola Kos Anda"){ echo "class=\"active\"";} ?>><a class="page-scroll" href="kosansaya">Kelola Kos Anda</a></li>
				<li></li>
				<li <?php if(\Session::get('active')=="Edit Akun"){ echo "class=\"active\"";} ?>><a class="page-scroll" href="editakun">Edit Akun</a></li>				
				<li></li>
				<li <?php if(\Session::get('active')=="Logout"){ echo "class=\"active\"";} ?>><a class="page-scroll" href="logout">Logout</a></li>
				<li></li>
				<?php }else{ ?>
				<li <?php if(\Session::get('active')=="Tentang Kami"){ echo "class=\"active\"";} ?>><a class="page-scroll" href="aboutUs">Tentang Kami</a></li>
				<li></li>
				<li <?php if(\Session::get('active')=="Bantuan"){ echo "class=\"active\"";} ?>><a class="page-scroll" href="help">Bantuan</a></li>
				<li></li>
				<li <?php if(\Session::get('active')=="Login"){ echo "class=\"active\"";} ?>><a class="page-scroll" href="login">Login</a></li>
				<li></li>
				<?php } ?>
				<div class="clearfix"></div>
			</ul>	
		</div>	
		<!----- script-for-nav ---->
		<script>
		$( "span.menu" ).click(function() {
			$( ".top-menu ul" ).slideToggle( "slow", function() {
			    // Animation complete.
			});
		});
		</script>
		<!----- script-for-nav ---->
	</div>


	@yield('content')
	<!---->
	<!---->
	<div class="fotter">
				<div class="container">
					<div class="fotter-info">
						<div class="fotter-logo">
							<a href="redirecthome"><img src="{{asset('images/logoFit.png')}}" alt=""/></a>
						</div>
						<div class="fotter-menu">			 
							<ul>
								<li><a href="index.html">Home</a></li>
								<li><a href="about.html">About Us</a></li>
								<li><a href="service.html">Shoponline</a></li>
								<li><a href="404.html">Help</a></li>
								<li><a href="carrers.html">Service</a></li>
								<li><a href="contact.html">Contact</a></li>
								<div class="clearfix"></div>
							</ul>				 
						</div>
						<div class="social-icons">
							<a href="#"><span class="fb"> </span></a>
							<a href="#"><span class="twt"> </span></a>
							<a href="#"><span class="gog"> </span></a>
							<a href="#"><span class="in"> </span></a>
							<a href="#"><span class="pin"> </span></a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<p class="copy-right">copyright 2015 CariKos.id &copy; Designed By <a href="http://w3layouts.com/">W3layouts</a></p>
			</div>

			<!---->
</body>
</html>
