<?php \Session::put('active','Kelola Kos Anda') ?>
@extends('layouts.master')

@section('content')
<!--topheader ends-->
<div class="service">
	 <div class="container"><br><br>

	 <?php if (count($arrayKosan)==0) {?>
	<div class="text-center contact2">
		
		<div class="col-md-1 "></div>
		<div class="col-md-2 ">
			<img src="images/pemilik.jpg">
		</div>
		<div class="col-md-1 "></div>
		<div class="speed-boats2">
			<div class="col-md-6 kosansaya boat-info">
				<h3>Daftarkan Kos Anda Sekarang!!</h3>
				<p> Anda belum memiliki kamar kos yang terdaftar. Untuk memulai pendaftaran, klik tombol "Tambah Baru"!</p>
					
				<a href="tambahkosan">Tambah Baru</a>
				<div class="arrow nip2"></div>
			</div>
			<div class="clearfix"></div>
		</div><br><br><br><br><br><br><br><br><br><br><br>
	</div>
 	<?php }else{ ?>

 	<div class="text-center contact2">

		<div class="col-md-1 "></div>
		<div class="col-md-2 ">
			<img src="images/pemilik.jpg">
		</div>
		<div class="col-md-1 "></div>
		<div class="speed-boats2">
			<div class="col-md-6 boat-info kosansaya">
				<h3>Daftar Kos yang Anda Kelola</h3>
				<p> Anda bisa mengubah data tempat kos yang anda kelola dan juga menambahkan tempat kos yang baru.</p>
					
				<a href="tambahkosan">Tambah Baru</a>
				<div class="arrow nip2"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="col-md-2 "></div>
	</div>
	<br>
	 <div class="content-bar kosan-saya service-boats">
	@foreach ($arrayKosan as $kosan)
		<div class="product-kosan-saya boats-grid">
			<div class="text-right more-product-info-new">
			<a class="" href="deletekosan/{{$kosan->id}}"><img src="images/failed.png" alt=""></a>	
			</div>					
			<div class="product-img no-margin b-link-stripe b-animate-go  thickbox">
				<img src="images/gambar_kosan/kosan{{\Session::get('id')}}/{{$kosan->id}}/cover.jpg" alt="">
				<div class="b-wrapper">
				<h4 class="b-animate b-from-left  b-delay03 shoponline">							
				<a href="editkosan/{{$kosan->id}}" class="btns">Edit</a>
				</h4>
				</div>
			</div>						
			<div class="">
				<ul class="cruiser-list">
					<br>
					<div class="row">
						<div class="col-md-4"><li>Kota  :</li></div>
						<div class="col-md-8 listkosansaya" >{{$kosan->kota}}</li></div>	
					</div>
					<div class="row">
						<div class="col-md-4"><li>Harga :</li></div>
						<div class="col-md-8 listkosansaya">{{number_format($kosan->harga_termurah)}}</li></div>	
					</div>
				 </ul>
			</div>
		</div>
	@endforeach
			 <div class="clearfix"></div>
		 </div>
	 
	<?php } ?>
	 </div>
	 </div>

@stop