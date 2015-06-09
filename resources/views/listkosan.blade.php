@extends('layouts.master')

@section('content')
<!--topheader ends-->
<!-- Products Page Starts Here -->
<?php 
	if(count($arrayKosan)>0){
		if(is_array($arrayKosan)){
			$arrayKos = $arrayKosan;
		}else{
			$arrayKos = $arrayKosan->toArray();
		}
		$id = array_map(function ($value){
			return $value['id'];
		}, $arrayKos);
		//return dd($id);
		\Session::put('arrayIdKosanForSorting',$id);
	}else{

		\Session::put('arrayIdKosanForSorting',[]);
	}
 ?>

<div class="product ">
	 <div class="container">
		 <div class="col-md-3 sidebar_men location-info">
	 		<h3 class = "text-center kategori">Terbaru</h3><br>
			  <ul class="product-categories color">

				@foreach ($arrayDataKotaTerbaru as $kota)
				<?php $string =  implode("+", $kota[1]); ?>
				<li class="line3"><a href="{{"listkosan/Lokasi Terbaru/".$string}}">{{$kota[0]}}</a> <span class="count">(.{{count($kota[1])}}.)</span></li>
				@endforeach
			 </ul>
	 		<h3 class = "text-center kategori">Harga Pertahun</h3><br>
			  <ul class="product-categories color">
				<?php
					if($arrayDataHarga[0]!=null) 
						$string = implode("+", $arrayDataHarga[0]); 
					else
						$string = '-1';
				?>
				<li class="line3"><a href="{{"listkosan/Harga  &lt; &nbsp;Rp 3,000,000/".$string}}">&lt; &nbsp;Rp 3,000,000</a> <span class="count">(.{{count($arrayDataHarga[0])}}.)</span></li>
				<?php
					if($arrayDataHarga[1]!=null) 
						$string = implode("+", $arrayDataHarga[1]); 
					else
						$string = '-1';
				?>
				<li class="line3"><a href="{{"listkosan/Harga  Rp 3,000,000 - Rp 5,000,000/".$string}}">Rp 3,000,000 - Rp 5,000,000</a> <span class="count">(.{{count($arrayDataHarga[1])}}.)</span></li>
				<?php
					if($arrayDataHarga[2]!=null) 
						$string = implode("+", $arrayDataHarga[2]); 
					else
						$string = '-1';
				?>
				<li class="line3"><a  href="{{"listkosan/Harga  Rp 5,000,000 - Rp 8,000,000/".$string}}">Rp 5,000,000 - Rp 8,000,000</a> <span class="count">(.{{count($arrayDataHarga[2])}}.)</span></li>
				<?php
					if($arrayDataHarga[3]!=null) 
						$string = implode("+", $arrayDataHarga[3]); 
					else
						$string = '-1';
				?>
				<li class="line3"><a  href="{{"listkosan/Harga  Rp 8,000,000 - Rp 12,000,000/".$string}}">Rp 8,000,000 - Rp 12,000,000</a> <span class="count">(.{{count($arrayDataHarga[3])}}.)</span></li>
				<?php
					if($arrayDataHarga[5]!=null) 
						$string = implode("+", $arrayDataHarga[5]); 
					else
						$string = '-1';
				?>
				<li class="line3"><a href="{{"listkosan/Harga  Rp 12,000,000 - Rp 15,000,000/".$string}}">Rp 12,000,000 - Rp 15,000,000</a> <span class="count">(.{{count($arrayDataHarga[4])}}.)</span></li>
				<?php
					if($arrayDataHarga[5]!=null) 
						$string = implode("+", $arrayDataHarga[5]); 
					else
						$string = '-1';
				?>
				<li class="line3"><a href="{{"listkosan/Harga  &gt; &nbsp; Rp 15,000,000/".$string}}">&gt; &nbsp; Rp 15,000,000</a> <span class="count">(.{{count($arrayDataHarga[5])}}.)</span></li>
			  </ul>
	 		<h3 class = "text-center kategori">Lokasi</h3><br>
			  <h3 class="listkosan">Provinsi</h3>
			  <ul class="product-categories color">
			  	@foreach ($arrayDataLokasiProvinsi as $provinsi)
 				<li class="line3"><a href="{{"listkosan/Provinsi/".$provinsi[0]}}">{{$provinsi[0]}}</a> <span class="count">(.{{$provinsi[1]}}.)</span></li>
 				@endforeach
 				<a class= "listkosan count pull-left" href="lokasi/Provinsi">Semua Provinsi</a>
 				
			 </ul>
			  <h3 class="listkosan">Kota </h3>
			  <ul class="product-categories color">

			  	@foreach ($arrayDataLokasiKota as $kota)
 				<li class="line3"><a href="{{"listkosan/Kota/".$kota[0]}}">{{$kota[0]}}</a> <span class="count">(.{{$kota[1]}}.)</span></li>
 				@endforeach
 				<a class= "listkosan count pull-left" href="lokasi/Kota">Semua Kota</a>
 				
			  </ul>
		 </div>
<div class="col-md-9 ctnt-bar">
		<div class="content-bar ">
				<ul class="product-head listkosan">
				<div class="row">
					<div class="col-md-1 ">
						<br>
						<img src="images/pemilik.png">
					</div>
					<br>
					<div class="col-md-11">
				<?php if(\Session::get('kategori')!="Hasil Pencarian"){ ?>
					<?php 
					if(\Session::has('arrayId')){ 
						\Session::put('query',"Nama Kota atau Provinsi");
						?>
						<h3 class="text-center">Masukkan Nama Kota atau Provinsi</h3>
					<?php }else{ ?>
						<?php if($arrayKosan==null) {?>
							<h3 class="text-center">Maaf Belum Ada Tempat Kos Yang Terdaftar</h3>
						<?php }else{ ?>
							<h3 class="text-center">Tempat Kos Yang Terdaftar</h3>
						<?php } ?>
					<?php } ?>

					<br>
					<h4 class="text-center"><b>Kategori : {{\Session::get('kategori')}}</b></h4>

				<?php }else{ ?>
						<h3 class="text-center">Hasil Pencarian</h3>
						<br>
						<h4 class="text-center"><b>Jumlah : {{count($arrayKosan)}}</b></h4>
				<?php } ?>
					<div class="clear"> </div>
					<div class="trip-pic listkosan ">
							{!! Form::open(['class'=>'text','class'=>'listkosan','url'=>"mencari", 'method'=>'PATCH'])!!}
						<?php if(\Session::has('arrayId')){  ?>
								<?php if(\Session::get('query')==null){
									\Session::put('query','Kata kunci pencarian');
								} ?>
								<input type="text" value="{{\Session::get('query')}}" name="query" onfocus="if(this.value=='Nama Kota atau Provinsi'){this.value=''}" onblur="if(this.value==''){this.value='Nama Kota atau Provinsi';}">
								
						<?php }else{ ?>
								<?php if(\Session::get('query')==null || \Session::get('query')=="Nama Kota atau Provinsi"){
									\Session::put('query','Kata kunci pencarian');
								} ?>
								<input type="text" value="{{\Session::get('query')}}" name="query" onfocus="if(this.value=='Kata kunci pencarian'){this.value=''}" onblur="if(this.value==''){this.value='Kata kunci pencarian';}">
						<?php } ?>
								<input type="submit" value="Cari">
							</form>
							{!!Form::close()!!}

							{!! Form::open(['class'=>'text','class'=>'listkosan','url'=>"urutkan", 'method'=>'PATCH'])!!}
								
								<div class="col-md-8 urutkan"  >
									<select  name="urutan"  class="urutkan" id="provinsi">
									  <option  <?php if($sorting == "ulasan") {?>selected <?php } ?>value="Jumlah Ulasan">Jumlah Ulasan</option>
									  <option <?php if($sorting == "pengunjung") {?>selected <?php } ?>value="Jumlah Pengunjung">Jumlah Pengunjung</option>
									  <option  <?php if($sorting == "termurah") {?>selected <?php } ?>value="Harga Termurah">Harga Termurah</option>
									  <option  <?php if($sorting == "termahal") {?>selected <?php } ?>value="Harga Termahal">Harga Termahal</option>
									</select>
								</div>
								<input class="urutkan" type="submit" value="Urutkan">
							</form>
							{!!Form::close()!!}
					</div>
					</div>
						<div class="row">
							&nbsp;
						</div>
					</div>
				</ul>
				<div class="products-row ">
					<?php if(count($arrayKosan)>0){?>
						@foreach ($arrayKosan as $kosan)
						<a href="single.html">
						<div class="product-grid">				
							<div class="product-img b-link-stripe b-animate-go  thickbox">
							<img src="images/gambar_kosan/kosan{{$kosan->id_pemilik}}/{{$kosan->id}}/cover.jpg" alt="">
								<div class="b-wrapper">
								<h4 class="b-animate b-from-left  b-delay03 shoponline">							
								<a href="redirectdetailkosan/{{$kosan->id}}" class="btns">Detail</a>
								</h4>
								</div>						
						</div>					
							<div class="product-info">
								<div class="product-info-price">
									<a href="details.html">Harga</a>
								</div>
								<div class="product-info-cust">
									<a href="details.html">&gt;=  Rp{{" ".number_format($kosan->harga_termurah)}}</a>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="product-info">
								<div class="product-info-price">
									<a href="details.html">Lokasi</a>
								</div>
								<div class="product-info-cust">
									<a href="details.html">{{$kosan->kota}}</a>
								</div>
								<div class="clearfix"> </div>
							</div>
						</div></a>
						
						@endforeach
					<?php } ?>
					<div class="clearfix"></div>
				</div>
				
	</div>
</div>
<div class="clearfix"></div>

	 </div>
</div>


@stop