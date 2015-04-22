@extends('layouts.master')

@section('content')
<!--topheader ends-->
<!-- Products Page Starts Here -->
<div class="product">
	 <div class="container">
		 <div class="col-md-3 sidebar_men">
			  <h3>Categories</h3>
			  <ul class="product-categories color">
				<li class="line3"><a href="#">BASS BOATS</a> <span class="count">(14)</span></li>
				<li class="line3"><a href="#">BOWRIDERS</a> <span class="count">(2)</span></li>
				<li class="line3"><a href="#">CABIN CRUISERS</a> <span class="count">(2)</span></li>
				<li class="line3"><a href="#">CATAMARANS</a> <span class="count">(8)</span></li>
				<li><a href="#">CENTRE CONSOLES</a> <span class="count">(11)</span></li>
				<li><a href="#">CUDDY CABINS</a> <span class="count">(3)</span></li>
				<li><a href="#">GAMEBOATS</a> <span class="count">(3)</span></li>
				<li><a href="#">HOUSEBOATS</a> <span class="count">(6)</span></li>
				<li class="line3"><a href="#">MOTORYACHTS</a> <span class="count">(13)</span></li>
				<li><a href="#">RUNABOUTS</a> <span class="count">(7)</span></li>
				<li><a href="#">SAILBOATS</a> <span class="count">(2)</span></li>
				<li class="line3"><a href="#">WALKAROUNDS</a> <span class="count">(17)</span></li>
			 </ul>
			  <h3>Colors</h3>
			  <ul class="product-categories color">
				<li><a href="#">Green</a> <span class="count">(14)</span></li>
				<li><a href="#">Blue</a> <span class="count">(2)</span></li>
				<li><a href="#">Red</a> <span class="count">(2)</span></li>
				<li><a href="#">Gray</a> <span class="count">(8)</span></li>
				<li><a href="#">Green</a> <span class="count">(11)</span></li>
			  </ul>
			  <h3>Sizes</h3>
			  <ul class="product-categories color">
				<li><a href="#">CRUISERS</a> <span class="count">300tons</span></li>
				<li><a href="#">XUV</a> <span class="count">200tons</span></li>
				<li><a href="#">CABINES</a> <span class="count">100tons</span></li>
			  </ul>
			  <h3>Price</h3>
			  <ul class="product-categories">
				<li class="line3"><a href="#">200$-300$</a> <span class="count">(14)</span></li>
				<li class="line3"><a href="#">300$-400$</a> <span class="count">(2)</span></li>
				<li><a href="#">400$-500$</a> <span class="count">(2)</span></li>
				<li><a href="#">500$-600$</a> <span class="count">(8)</span></li>
				<li><a href="#">600$-700$</a> <span class="count">(11)</span></li>
			  </ul>
		 </div>
<div class="col-md-9 ctnt-bar">
		<div class="content-bar">
				<ul class="product-head">
					<h3>Kamar Baru Bulan ini :</h3>
					<div class="clear"> </div>
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
								<a href="details.html">Rp{{" ".$kosan->harga}}</a>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div></a>
					
					@endforeach
					
					<div class="clearfix"></div>
				</div>
				
	</div>
</div>
<div class="clearfix"></div>

	 </div>
</div>


@stop