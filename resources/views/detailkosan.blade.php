
@extends("layouts.master")

<script src="js/jquery.min.js"></script>

	 <script type="text/javascript"><!--
	 var limitJudul = 50;
	 var limitIsi = 1000;
	 function check() {
	   if(document.tulis_ulasan.judul_ulasan.value.length > limitJudul || document.tulis_ulasan.isi_ulasan.value.length > limitIsi) {
	     alert('Maaf, pengisian judul dan isi ulasan melebihi batas karakter yang diizinkan!');
	     return false; }
	   else
	     return true; }
	 function update(jenis) {
	 	if(jenis=="judul_ulasan"){
		   if(document.tulis_ulasan.judul_ulasan.value.length > limitJudul ) {
		     	alert('Judul terlalu panjang! Maksimal '+limitJudul+' karakter.');
		      }
		}else{
			if(document.tulis_ulasan.isi_ulasan.value.length > limitIsi ) {
		     	alert('Isi terlalu panjang! Maksimal '+limitIsi+' karakter.');
		      }
		}
	}
 //-->
 </script>

</div>
</div>	
</div>

@section('content')
<div class="product">
	<div class="container">
		<div class="col-md-12 ctnt-bar cntnt">

			<div class="row">
					<div class="col-md-3">
						
					</div>
					<div class="col-md-2 ">
						<img src="images/pemanduDetail.png">
					</div>
					<div class="col-md-2 "></div>
					<div class="speed-boats2">
						
					<div class="col-md-5">

						<div class="col-md-12 boat-info boat-info-home">
							<h4>Detail tempat kos !</h4>
							<p> Temukan kamar kos lain sesuai kata kunci Anda</p>
								
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

					</div>

					</div>
					
				</div>


			<div class="content-bar background-tambahkosan">
				<div class="single-page">
					
					<!-- Include the Etalage files -->
					<link rel="stylesheet" href="css/etalage.css">
					<script src="js/jquery.etalage.min.js"></script>
					<!-- Include the Etalage files -->
					<script>
					jQuery(document).ready(function($){

								$('#etalage').etalage({
									thumb_image_width: 450,
									thumb_image_height: 300,
									source_image_width: 1125,
									source_image_height: 750,
									show_hint: true,
									click_callback: function(image_anchor, instance_id){
										alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
									}
								});
						// This is for the dropdown list example:
						$('.dropdownlist').change(function(){
							etalage_show( $(this).find('option:selected').attr('class') );
						});

					});
					</script>

					<?php 
						$subPath = "images/gambar_kosan/kosan".$kosan->id_pemilik."/".$kosan->id;
						$files = array();
						try{
							$path = dirname(dirname(dirname(__DIR__)))."/public/".$subPath;
							$directory = opendir($path);
							while($file = readdir($directory)){
							    if($file !== '.' && $file !== '..'){
							    	$files[]= $file;
							        //echo '<img src="images/gambar_kosan/kosan'.\Session::get('id').'/'.$file.'" border="0" />';
							    }
							}
						}catch (\Exception $e) {

					}
					 ?>

					<div class="details-left-slider">
						<ul id="etalage">
							<?php if(count($files)==0){ ?>
							<li>
								<a href="optionallink.html">
									<img  class="etalage_thumb_image" src="images/empty.jpg" />
									<img class="etalage_source_image" src="images/empty.jpg" />
								</a>
							</li>
							<?php }else{ ?>
							@foreach ($files as $image)
							
							<li>
								<img "thumb_image_width"="450" class="etalage_thumb_image" src="{{$subPath."/".$image}}" />
								<img class="etalage_source_image" src="{{$subPath."/".$image}}"/>
							</li>
							@endforeach
							<?php } ?>
							<div class="clearfix"></div>
						</ul>
					</div>
					<div class="details-left-info">
						<div class="contact2">
							<!-- <h3 class="text-center tambahkosan" >Deskripsi</h3> -->
							
							<form>
							<div class="row">
								<div class="text-left col-md-4">
									<br>
									<p>Lokasi :</p>
								</div>
								<div class="col-md-8 detailkosan">
									<input type="text" class="text" value="{{$kosan->lokasi}}" name='lokasi' onfocus="if (this.value == 'Lokasi'){this.value = '';}" onblur="if (this.value == '') {this.value = 'Lokasi';}" readonly/>
								</div>
							</div>


							<div class="row">
								<div class="text-left col-md-4">
									<br>
									<p>Harga :</p>
								</div>
								<div class="col-md-8 detailkosan">
									<input type="text" class="text" value="{{$kosan->harga_termurah}}" name='harga_termurah' onfocus="if (this.value == 'Harga'){this.value = '';}" onblur="if (this.value == '') {this.value = 'Harga';}" readonly/>
								</div>
							</div>
							<div class="row">
								<div class="text-left col-md-4">
									<br>
									<p>Nama Pemilik :</p>
								</div>
								<div class="col-md-8 detailkosan">
									<input type="text" class="text" value="{{$kosan->nama_pemilik}}" name='nama_pemilik' onfocus="if (this.value == 'Nama Pemilik'){this.value = '';}" onblur="if (this.value == '') {this.value = 'Nama Pemilik';}" readonly/>
								</div>
							</div>
							<div class="row">
								<div class="text-left col-md-4">
									<br>
									<p>Nomor Telepon :</p>
								</div>
								<div class="col-md-8 detailkosan">
									<input type="text" class="text" value="{{$kosan->no_tlp}}" name='no_tlp' onfocus="if (this.value == 'Nomor Telepon'){this.value = '';}" onblur="if (this.value == '') {this.value = 'Nomor Telepon';}" readonly/>
								</div>
							</div>
							<div class="row">
								<div class="text-left col-md-4">
									<br>
									<p>Fasilitas :</p>
								</div>
								<div class="col-md-8 detailkosan">
									<textarea name='deskripsi_fasilitas'  onfocus="if (this.value == 'Fasilitas'){this.value = '';}" readonly onblur="if (this.value == '') {this.value = 'Fasilitas';}">{{$kosan->deskripsi_fasilitas}} </textarea>
								</div>
							</div>
							<div class="row">
								<div class="text-left col-md-4">
									<br>
									<p>Deskripsi Kondisi :</p>
								</div>
								<div class="col-md-8 detailkosan">
									<textarea name='deskripsi_kondisi'  onfocus="if (this.value == 'Kondisi'){this.value = '';}"  readonly  onblur="if (this.value == '') {this.value = 'Kondisi';}">{{$kosan->deskripsi_kondisi}} </textarea>
								</div>
							</div>
						</div>
					</form>
					</div>
					<div class="clearfix"></div>
				</div>
					<div class="text-center ">
						<a type="button" href="listkosan" class="text-left btn btn-btn btn-info">Kembali</a>
					</div>
					<br>
			</div>
			
			<br><br>
					<div class="contact2">
						<div class="col-md-2 ">
							<img src="images/pemanduUlasan.png">
						</div>
	
							<div class=" col-md-7 speed-boats2 detailkosan">
								<?php if(\Session::has('id')){ ?>

									<?php if($ulasan==null){ ?>
										<div class="col-md-12 boat-info ulasan">
											<div class="arrow nip2"></div>
											
											{!! Form::open(['class'=>'text-right','onsubmit'=>'return check()', 'name'=>'tulis_ulasan', 'url'=>"kirimulasan", 'method'=>'PATCH'])!!}
											<div id="kota" class="text-center deskripsi-middle "><h4 class="bacaulasan">Tambahkan Ulasan Anda</h4> </div>
											
											<input onkeyup="update('judul_ulasan');" value="Judul Ulasan" type = "text"  class = "judululasan" name='judul_ulasan'  onfocus="if (this.value == 'Judul Ulasan'){this.value = '';}" onblur="if (this.value == '') {this.value = 'Judul Ulasan';}"required></input>
											<br>
											<textarea onkeyup="update('isi_ulasan');" value="Kondisi"  class = "ulasan" name='isi_ulasan'  onfocus="if (this.value == 'Isi Ulasan'){this.value = '';}" onblur="if (this.value == '') {this.value = 'Isi Ulasan';}"required>Isi Ulasan</textarea>
											
											<div class="single-but ulasan">
												<input type="submit" class="ulasanbtn" onclick="changeNumber()" value="Tambahkan"/>
											</div>
											{!!Form::close()!!}
										</div>
									<?php }else{ ?>
										<div class="col-md-12 boat-info ulasan">
											<div class="arrow nip2"></div>
											{!! Form::open(['class'=>'text-right','url'=>"editulasan", 'method'=>'PATCH'])!!}
											<div id="kota" class="text-center deskripsi-middle "><h4 class="bacaulasan">Ulasan Anda</h4> </div>
											
											<input  value="{{$ulasan->judul_ulasan}}" type = "text"  class = "judululasan" name='judul_ulasan'  onfocus="if (this.value == 'Judul Ulasan'){this.value = '';}" onblur="if (this.value == '') {this.value = 'Judul Ulasan';}"readonly></input>
											<br>
											<textarea value="Kondisi"  class = "ulasan" name='isi_ulasan'  onfocus="if (this.value == 'Isi Ulasan'){this.value = '';}" onblur="if (this.value == '') {this.value = 'Isi Ulasan';}" readonly>{{$ulasan->isi_ulasan}}</textarea>
											
											<div class="single-but ulasan">
												<input type="submit" class="ulasanbtn" onclick="changeNumber()" value="Edit"/>
											</div>
											{!!Form::close()!!}
										</div>
									<?php } ?>
								<?php }else{ ?>

										<div class="col-md-12 boat-info ulasan">
										<div class="arrow nip2"></div>
										{!! Form::open(['class'=>'text-right','url'=>"login", 'method'=>'PATCH'])!!}
										<div id="kota" class="text-center deskripsi-middle "><h4 class="bacaulasan">Login untuk Memberikan Ulasan</h4> </div>
										<br>
										<div class="row">
											<div class="text-left textmiddle col-md-4">											
												<h5 class= "loginulasan">Email :</h5>
											</div>
											<div class="col-md-8 detailkosan">
												<input type="text"value="E-mail"  class = "email judululasan" name='email'  onfocus="if (this.value == 'E-mail'){this.value = '';}" onblur="if (this.value == '') {this.value = 'E-mail';}"></input>
											</div>
										</div>
										<div class="row">
											<div class="text-left textmiddle col-md-4">											
												<h5 class= "loginulasan">Password :</h5>
											</div>
											<div class="col-md-8 detailkosan">
												<input type="password" value="Password"  class = "judululasan" name='password'  onfocus="if (this.value == 'Password'){this.value = '';}" onblur="if (this.value == '') {this.value = 'Password';}"></input>
											</div>
										</div>
											<div class="text-center textmiddle col-md-11">							
												<div class="single-but ulasan">
													<a class="tanpa-button " href="lupapassword">Lupas Password ?</input></a>
												</div>				
											</div>	
											<div class="text-center textmiddle col-md-11">		
												<div class="single-but ulasan">
													<a class="tanpa-button " href="login">Mendaftar</input></a>
												</div>
											</div>
											<div class="single-but ulasan">
												<input class="loginbtn" type="submit" value="Masuk"/>
											</div>
										{!!Form::close()!!}
									</div>
								<?php } ?>
							</div>

							<div class=" col-md-2 speed-boats2 detailulasan">
								<div class="col-md-12 boat-info detailulasan">
									<div class="arrow nip1"></div>
									<div id="kota" class="text-center deskripsi-middle "><h2 class="bacaulasan">{{$kosan->jumlah_ulasan}}</h2> </div>
									
									<div id="kota" class="text-center deskripsi-middle "><h4 class="bacaulasan">Ulasan</h4> </div>
									<?php if($kosan->jumlah_ulasan!=0) {?>
										<div class="single-but ulasan">
											<a class="bacaulasan" href = "bacaulasan" onClick = "showUlasan()" >Baca Ulasan</input></a>
											<!-- <button class="noBackground"><a class="bacaulasan" onClick = "showUlasan()" >Baca Ulasan</input></a> -->
											
										</div>
									<?php } ?>
								</div>
								<div class="col-md-12">
								<br>
								</div>
								<div class="col-md-12 boat-info pengunjung">
									<div id="kota" class="text-center deskripsi-middle "><h2 class="pengunjung">{{$kosan->dilihat}}</h2> </div>
									
									<div id="kota" class="text-center deskripsi-middle "><h4 class="pengunjung">Pengunjung</h4> </div>
									
								</div>
							</div>

						<div class="col-md-2 ">
							<img src="images/pemanduKanan.png">
						</div>
					</div>

			<br><br>

			<?php if($arrayUlasan!=null) {?>
				
			<div class="row" id="ulasan" >
				<!-- <div id = "iniulasan">cdscsds</div> -->
			<div class="row col-md-12"  >
				<br><br>
				<ul class="product-head ulasan detailkosan" >
					<div class="text-center">
						<h3 class="adalain putih">Daftar Ulasan</h3>
					</div>
					<div class="clear"> </div>
				</ul>	
				<?php $var = 1; ?>
				@foreach($arrayUlasan as $ulasan)
					<div class="row backgroundUlasan{{$var%2}}">
						<div class="col-md-2"></div>
						<div class="col-md-4 ">
							<img src="images/pemanduDetail.png">
						</div>

						<div class="col-md-8">
							<div class="row">
							<div class="col-md-12 boat-info boat-info-home ulasan">
								<h4 class="judululasan">{{$ulasan->judul_ulasan}}</h4>
								<p class="isiulasan"> {{$ulasan->isi_ulasan}}</p>
									
								<div class="arrow nip2 ulasan"></div>
							</div>
							</div>
							<div class="row">
						<div class = "md-col-5">
							<br>
							<h3 class="pengulas">oleh : {{$ulasan->nama_user}}</h3>
						</div>
							</div>
						</div>
					</div>
					<?php $var = $var+1; ?>
				@endforeach
			</div>
			</div>
			<?php } ?>
			<?php if($arrayKosan != null){ ?>
			<div class="row col-md-12">
			<br><br>
				<ul class="product-head ulasan detailkosan">
					<div class="text-center ">
						<h3 class="adalain putih">Tempat Kos Lain di Kota {{$kosan->kota}}</h3>
					</div>
					<div class="clear"> </div>
				</ul>	
			</div>
			<?php } ?>
			<div class="content-bar kosan-saya service-boats">
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


		</div>

	</div>
	</div>
	






<script>

function showUlasan(){
	
	document.getElementById("iniulasan").innerHTML = "iini ";  
};
</script>
<?php 
	function tes(){
		return "lala";
	}
 ?>

	@stop