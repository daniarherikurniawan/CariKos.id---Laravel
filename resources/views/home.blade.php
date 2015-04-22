@extends('layouts.master')

@section('content')
<script>
$(function () {
	$("#slider").responsiveSlides({
		auto: true,
		speed: 1000,
		timeout: 60E3,
		namespace: "callbacks",
		pager: true,
	});
});
</script>
<script src="js/responsiveslides.min.js"></script>
<div class="slider">
	<div class="callbacks_container">
		<ul class="rslides" id="slider">
			<?php 
			$i = 1;
			for($i=3; $i < 6; $i++){ ?>
			<li>


				<img src={{"images/b".$i.".jpg"}} alt=""/>

				<div class="caption">
					<div class="logo">


						<div class="col-md-4 ">
							<a href="home"><img src="images/logo.png"></a>	

						</div>
						<div class="col-md-6 contact2-new pull-left">
							<br><br>
							<form>
								<input type="text" class="text" value="Nama Kota" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Nama Kota';}">
							</form>
						</div>
						<div class="col-md-2 contact2 pull-left">
							<br>
							<form>
								<input type="submit" class="text" value="Cari">
							</form>
						</div>

					</div>
					<h2 class="text-center">Find your finest rent room!</h2>
				</div>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>

<?php if(\Session::has('id')==false){ ?>
<div class="trip" id= "login"</id>
	<div class="col-md-12  stripSubMenu navbar-top navbar "><br>
	</div><br><br><br>
	<h2>Login</h2><br><br>
	<!--topheader starts-->	 

	<div class="contact-form">
		<div class="container">
			<div class="col-md-5 contact2">
				<h3 class="text-center" >Login</h3>
				{!! Form::open(['class'=>'text-right','url'=>"login", 'method'=>'PATCH'])!!}
				<input type="email" class="text" value="E-mail" name='email' onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-mail';}" required>
				<input type="password" class="text" value="Password" name='password' onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required>
				<div class=""><a href="lupaPassword">Lupa Password?</a></div>
				<input type="submit" value="Login">
				{!!Form::close()!!}
			</div>
			<div class="text-center col-md-2 ">
				<br><br><br><br><br>
				<img width="70px" src="images/atau.png">
			</div>
			<div class="col-md-5 contact2">
				<h3 class="text-center">Mendaftar</h3>
				{!! Form::open(['class'=>'text-right','url'=>"signup", 'method'=>'PATCH'])!!}
				<input type="text" class="text" name='nama' value="Nama" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Nama';}" required >
				<input type="email" class="text" name='email' value="E-mail" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-mail';}" required >
				<input type="password" class="text" name='password' value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}"  required>
				<input 	type="submit" value="Mendaftar">
				<div><a href=""></a></div>
				{!!Form::close()!!}
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

</div>
<!---->
<?php } ?>

<div class="trip" id="help">
	<div class="col-md-12  stripSubMenu navbar-top navbar "><br>
	</div><br><br><br>
	<h2>Bantuan</h2><br><br>
	<div class="speed-boats1">
		<div class="col-md-4 boat-info">
			<h3>03.  UNCOVER MANY</h3>
			<p>But also the leap into electronic typesetting,remaining essentially unchanged. It was popularised in the 1960s with the release of 	etraset sheets containing Lorem Ipsum 
				passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
				<a href="#">More</a>
				<div class="arrow"></div>
			</div>
			<div class="col-md-8 boat-pic">			 
				<a href="#" class="b-link-stripe b-animate-go  thickbox">
					<img class="port-pic" src="images/boat1.jpg" />
					<div class="b-wrapper">
						<h4 class="b-animate b-from-left  b-delay03 ">							
							<button>KNOW MORE</button>
						</h4>
					</div>
				</a>
			</div>
			<div class="clearfix"></div>
		</div>

		<div class="speed-boats2">	     
			<div class="col-md-8 boat-pic">			 
				<a href="#" class="b-link-stripe b-animate-go  thickbox">
					<img class="port-pic" src="images/boat2.jpg" />
					<div class="b-wrapper">
						<h4 class="b-animate b-from-left  b-delay03 ">							
							<button>KNOW MORE</button>
						</h4>
					</div>
				</a>
			</div>

			<div class="col-md-4 boat-info">
				<h3>04.  LEX</h3>
				<p>But also the leap into electronic typesetting,remaining essentially unchanged. It was popularised in the 1960s with the release of 	etraset sheets containing Lorem Ipsum 
					passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
					<a href="#">More</a>
					<div class="arrow nip2"></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<!--  -->
		<div class="trip" id="aboutUs">

			<div class="col-md-12  stripSubMenu navbar-top navbar "><br>
			</div><br><br><br>
			<h2>Tentang Kami</h2><br><br>
			<div class="trip-pic">	 
				<div class="container">		 
					<h3>Always Wear</h3>
					<h4>A Life Jacket while Boating</h4>
					<p class="line3">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical</p>
					<p class="line1"> Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia.</p>
					<p class="line2">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical</p>
					<p> Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,</p>
					<form>
						<input type="text" value="E-mail For Updates" onfocus="this.value=''" onblur="this.value='E-mail For Updates'">
						<input type="submit" value="subscride">
					</form>
				</div>
			</div>
		</div>

		@stop
