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
						<div class="col-md-6 contact2-new home-query pull-left">
							<br><br>
							{!! Form::open(['class'=>'text','class'=>'home','url'=>"mencari", 'method'=>'PATCH'])!!}
							
							<form>
								<input class="home" name= "query" type="text" class="text" value="Masukkan nama kota/ pemilik/ harga/ kata kunci lain" onfocus="if (this.value == 'Masukkan nama kota/ pemilik/ harga/ kata kunci lain') {this.value = '';}"  onblur="if (this.value == '') {this.value = 'Masukkan nama kota/ pemilik/ harga/ kata kunci lain';}">
							
						</div>
						<div class="col-md-2 contact2 pull-left">
							<br>
							<form>
								<input type="submit" class="home text" value="Cari">
							{!!Form::close()!!}
						</div>
					</div>
					<h2 class="text-center">Find your finest rent room!</h2>
					<div class="col-md-2 ">
						<br><br><br><br><br><br><br><br><br>
						<img class = "penyambut" src="images/penyambut.png">
					</div>
					<div class="speed-boats2">
						<br><br><br><br><br><br><br><br><br>
						<div class="col-md-4 boat-info boat-info-home">
							<h4>Selamat Datang!</h4>
							<p>Silahkan masukkan kata kunci untuk mencari tempat kos yang Anda inginkan. Kata kunci bisa berupa lokasi, pemilik, harga atau info lain.</p>
								
							<a class="text-center" href="help">Pelajari</a>
							<div class="arrow nip2"></div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>

<div class="trip" id="help">
	<div class="col-md-12  stripSubMenu navbar-top navbar "><br>
	</div><br><br>
	<div class="speed-boats1">
		<div class="col-md-5 boat-info">
			<h3>Pemilik kos</h3>
			<p>Anda sebagai pemilik kos bisa mempromosikan kamar kos dengan mudah melalui website ini. Sebelum mendaftarkan tempat kos, Anda harus membuat akun terlebih dahulu. Keterangan yang harus disediakan berupa: lokasi tempat kos, harga, nama pemilik, no. telepon, fasilitas, dsb.</p>
				<a href="#">Pelajari</a>
				<div class="arrow"></div>
			</div>
			<div class="col-md-7 boat-pic">			 
				<a href="#" class="b-link-stripe b-animate-go  thickbox">
					<img class="port-pic" src="images/pemilikKos.png" />
					<div class="b-wrapper">
						<h4 class="b-animate b-from-left  b-delay03 ">							
							<button>Pelajari</button>
						</h4>
					</div>
				</a>
			</div>
			<div class="clearfix"></div>
		</div>

		<div class="speed-boats2">	     
			<div class="col-md-7 boat-pic">			 
				<a href="#" class="b-link-stripe b-animate-go  thickbox">
					<img class="port-pic" src="images/pencariKos.png" />
					<div class="b-wrapper">
						<h4 class="b-animate b-from-left  b-delay03 ">							
							<button>Pelajari</button>
						</h4>
					</div>
				</a>
			</div>

			<div class="col-md-5 boat-info">
				<h3>Pencari Kos</h3>
				<p>Anda sebagai pencari kos bisa melakukan pencarian tempat kos dengan berbagai kata kunci melalui halaman utama. Tempat kos bisa ditampilkan terurut berdasarkan harga, lokasi, dan jumlah review terbanyak. Anda harus login untuk memberikan ulasan.</p>
					<a href="#">Pelajari</a>
					<div class="arrow nip2"></div>
				</div>
				<div class="clearfix"></div>
			</div>
		<br><br><br><br>
		</div>
		<!--  -->


<?php if(\Session::has('id')==false){ ?>
<div class="trip" id= "login"</id>
	<div class="col-md-12  stripSubMenu navbar-top navbar "><br>
	</div><br><br><br>
	<!--topheader starts-->	 

	<div class="contact-form">
		<div class="container">

			<div class="col-md-1"></div>
			<div class="col-md-2 ">
				<img src="images/pemanduLoginHome.png">
			</div>
			
			<div class="col-md-9">
				<div class="speed-boats2">
					<div class="col-md-1"></div>
					<div class="col-md-8 boat-info-login">
						<h4 class ="boat-info-login">Silahkan masukkan email dan password Anda!</h4>
						<br>
						<p>Akun digunakan untuk mendaftarkan kamar kos yang ingin dipromosikan melalui website ini. Silahkan mendaftar jika belum memiliki akun.</p>
							
						<div class="arrow nip2"></div>
					</div>
					<div class="clearfix"></div>
				</div>
				<br><br>
					<div class="col-md-3 contact2">
						<h3 class="text-center" >Masuk</h3><br>
						{!! Form::open(['class'=>'text-right','url'=>"login", 'method'=>'PATCH'])!!}
						<input type="email" class="text" name='email' value="E-mail" onfocus="if (this.value == 'E-mail') {this.value = '';}" onblur="if (this.value == '') {this.value = 'E-mail';}" required >
						<input type="password" class="text" name='password'  value="Password" onfocus="if (this.value == 'Password') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Password';}"  required>
						<div class=""><a href="lupaPassword">Lupa Password?</a></div>
						<input type="submit" value="Login">
						{!!Form::close()!!}
					</div>
					<div class="text-center col-md-2 ">
						<br><br><br><br><br>
						<img width="70px" src="images/atau.png">
					</div>
					<div class="col-md-3 contact2">
						<h3 class="text-center">Mendaftar</h3><br>
						{!! Form::open(['class'=>'text-right','url'=>"signup", 'method'=>'PATCH'])!!}
						<input type="text" class="text" name='nama' value="Nama" onfocus="if (this.value == 'Nama') {this.value = '';}"  onblur="if (this.value == '') {this.value = 'Nama';}" required >
						<input type="email" class="text" name='email' value="E-mail" onfocus="if (this.value == 'E-mail') {this.value = '';}" onblur="if (this.value == '') {this.value = 'E-mail';}" required >
						<input type="password" class="text" name='password'  value="Password" onfocus="if (this.value == 'Password') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Password';}"  required>
						<input 	type="submit" value="Mendaftar">
						<div><a href=""></a></div>
						{!!Form::close()!!}
					</div>
			</div>		

			<div class="clearfix"></div>
			<br><br><br><br><br><br><br><br><br>
		</div>
	</div>

</div>
<!---->
<?php } ?>


		<div class="trip" id="aboutUs">

			<div class="col-md-12  stripSubMenu navbar-top navbar "><br>
			</div><br><br>
			<div class="trip-pic">	 
				<div class="container">		
					<br>
					<h4 class="text-center">OneDev-Team</h4>
					<div class="col-md-2 ">
						<img src="images/timKami.png">
					</div> 
					<div  class="col-md-10">
					<h5 class="text-left"> Tim kami terdiri dari 5 anggota, yaitu : </h5>
					<h5 class="text-left"> 1. Jan Wira Gotama P. </h5>
					<h5 class="text-left"> 2. Daniar Heri K. </h5>
					<h5 class="text-left"> 3. Susanti Gojali </h5>
					<h5 class="text-left"> 4. Jonathan Sudibya </h5>
					<h5 class="text-left"> 5. Tifani Warnita </h5>
					<div class="md-col-12">
						<form>
							<input type="text" value="E-mail For Updates" onfocus="this.value=''" onblur="this.value='E-mail For Updates'">
							<input type="submit" value="subscride">
						</form>
					</div>
					</div>
				</div>
			</div>
		</div>

		@stop
