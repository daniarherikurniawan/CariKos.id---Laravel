@extends('layouts.master')

@section('content')
<!--topheader ends-->
<!-- Products Page Starts Here -->
<?php 
$arrayDataLokasi = \Session::get('arrayDataLokasi');
 ?>
<div class="product ">
	 <div class="container">
		 <div class="col-md-3 sidebar_men location-info">
	 		<h3 class = "text-center kategori">{{\Session::get('jenislokasi')}}</h3><br>
			  <ul class="product-categories color">
			  	<?php 
			  	//dd(\Session::get('Selected')) ?>
				@foreach ($arrayDataLokasi as $lokasi)
				 <li class="line3"><a href="{{\Session::get('jenislokasi')."/".$lokasi[0]}}">{{$lokasi[0]}}</a> <span class="count">(.{{$lokasi[1]}}.)</span></li>
				@endforeach
			 </ul>
		 </div>
<div class="col-md-9 ctnt-bar">
		<div class="content-bar">
			<?php if(\Session::has('Selected')){ ?>
				<ul class="product-head">
				<div class="row">
					<div class="col-md-0">
							

					</div>

					<div class="col-md-12">
							
						<h3 class="text-center">Tempat Kos Yang Terdaftar</h3>
						<br>
						<h4 class="text-center"><b>Lokasi : {{\Session::get('kategori')}}</b></h4>
						<div class="clear"> </div>
						<?php \Session::forget('Selected'); ?>
						
						<div class="col-md-12">
							<div class="clear"> </div>
							<?php \Session::forget('Selected'); ?>
							<div class="trip-pic listkosan ">
							{!! Form::open(['class'=>'text','class'=>'lokasi listkosan','url'=>"mencari", 'method'=>'PATCH'])!!}
								<input type="text" value="Kata kunci pencarian" name="query" onfocus="if(this.value=='Kata kunci pencarian'){this.value=''}" onblur="if(this.value==''){this.value='Kata kunci pencarian';}">
								<input type="submit" value="Cari">
							</form>
							{!!Form::close()!!}
							</div>
						<br>
						</div>
					</div>
				</div>
				</ul>
				<div class="products-row ">
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
					
					<div class="clearfix"></div>
				</div>
				<div class="text-center ">
					<br>
					<a type="button" href="lokasi/{{\Session::get('jenislokasi')}}" class="text-left btn btn-btn btn-info"> Kembali</a>
				</div>
				<div class="clear"> </div>

		<?php }else{ ?>
				<ul class="product-head">
				<div class="row">
					<div class="col-md-2 ">
						<img src="images/penyambutPencarian.png">
					</div>
					<div class="col-md-2 "></div>
					<div class="speed-boats2">
						
					<div class="col-md-7">

						<div class="col-md-12 boat-info boat-info-home">
							<h4>Masukkan Nama {{\Session::get('jenislokasi')}}!</h4>
							<p> Temukan kamar kos yang paling tepat untuk Anda.</p>
								
							<div class="arrow nip2"></div>
						</div>

						<div class="col-md-12">
							<div class="clear"> </div>
							<?php \Session::forget('Selected'); ?>
							<div class="trip-pic listkosan ">
							{!! Form::open(['class'=>'text','class'=>'lokasi listkosan','url'=>"mencari", 'method'=>'PATCH'])!!}
								
								<input type="text" value="Kata kunci pencarian" name="query" onfocus="if(this.value=='Kata kunci pencarian'){this.value=''}" onblur="if(this.value==''){this.value='Kata kunci pencarian';}">
								<input type="submit" value="Cari">
							</form>
							{!!Form::close()!!}
							</div>
						</div>
						<div class="clearfix"></div>

						<div class="text-center ">
							<br><br><br>
							<a type="button" href="listkosan" class="text-left btn btn-btn btn-info"> Kembali</a>
						</div>
					</div>

					</div>
					
				</div>
				</ul>
				
				<div class="clear"> </div>
		<?php } ?>
	</div>
</div>
<div class="clearfix"></div>

	 </div>
</div>


@stop