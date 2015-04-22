<?php \Session::put('active','Kelola Kos Anda') ?>
@extends('layouts.master')

@section('content')
<!--topheader ends-->
<div class="service">
	 <div class="container"><br><br>

	 <?php if (count($arrayKosan)==0) {?>
	<div class="text-center contact2"><br><br>
		 <h2 class="text-center">Anda belum memiliki kamar kos yang terdaftar.</h2> 
			<a href="tambahkosan"><input type="button" value="Tambahkan"></a>
		<br><br><br><br><br><br><br><br><br><br><br><br>
	</div>
 	<?php }else{ ?>

 	<div class="text-center contact2">
		 <h2 class="text-center">Daftar Kos yang Anda Kelola</h2> 
			<a href="tambahkosan"><input type="button" value="Tambah Baru"></a>
		<br><br>
	</div>
	 <div class="content-bar service-boats">
	@foreach ($arrayKosan as $kosan)
		<div class="product-grid boats-grid">
			<div class="text-right more-product-info-new">
			<a class="" href="deletekosan/{{$kosan->id}}"><img src="images/failed.png" alt=""></a>	
			</div>					
			<div class="product-img b-link-stripe b-animate-go  thickbox">
				<img src="images/gambar_kosan/kosan{{\Session::get('id')}}/{{$kosan->id}}/cover.jpg" alt="">
				<div class="b-wrapper">
				<h4 class="b-animate b-from-left  b-delay03 shoponline">							
				<a href="editkosan/{{$kosan->id}}" class="btns">Edit</a>
				</h4>
				</div>
			</div>						
			<div class="">
				<ul class="cruiser-list">
					<h4 class="text-center">Deskripsi</h4>
					<div class="row">
						<div class="col-md-4"><li>Lokasi :</li></div>
						<div class="col-md-8">{{$kosan->lokasi}}</li></div>	
					</div>
					<div class="row">
						<div class="col-md-4"><li>Harga :</li></div>
						<div class="col-md-8">{{$kosan->harga}}</li></div>	
					</div>
					<div class="row">
						<div class="col-md-4"><li>Pemilik :</li></div>
						<div class="col-md-8">{{$kosan->nama_pemilik}}</li></div>	
					</div>
					<div class="row">
						<div class="col-md-4"><li>Telepon :</li></div>
						<div class="col-md-8">{{$kosan->no_tlp}}</li></div>	
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