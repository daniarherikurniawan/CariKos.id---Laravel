
@extends("layouts.master")

<script src="js/jquery.min.js"></script>
 <script type="text/javascript"><!--
	 var limitHarga = 11;
	 var limitJalan = 200;
	 var limitNamaPemilik = 40;
	 var limitNomorTlp = 40;
	 var limitFasilitas = 1000;
	 var limitKondisi = 1000;

	 function check() {
	    if(document.tambah_kosan.harga_termurah.value == "Harga" ||document.tambah_kosan.harga_termurah.value == "Harga" ){
	 		alert('Maaf, harga harus di isi!');
	     return false; 
	 	}else if(document.tambah_kosan.provinsi.value == "Provinsi" || document.tambah_kosan.kota.value == "Kota" ) {
	     alert('Maaf, provinsi dan kota harus di pilih!');
	     return false; 
	 	} else if(document.tambah_kosan.lokasi.value == "Jalan" ){
	 		alert('Maaf, jalan harus di isi!');
	     return false; 
	 	}else if(document.tambah_kosan.nama_pemilik.value == "Nama Pemilik" || document.tambah_kosan.no_tlp.value == "Nomor Telepon" 
	 			|| document.tambah_kosan.deskripsi_fasilitas.value == "Fasilitas" || document.tambah_kosan.deskripsi_kondisi.value == "Kondisi" ) {
	     alert('Maaf, kolom deskripsi harus diisi dengan lengkap!');
	     return false; 
	 	}else{
	     return true; 
	 	}
	   }
	 function update(jenis) {
	 	switch(jenis){
	 		case "harga_termurah":
	 			if(document.tambah_kosan.harga_termurah.value.length > limitHarga ) {
		     	alert('Harga terlalu panjang! Maksimal '+limitHarga+' karakter.');
		      }

	 			break;
	 		case "harga_termahal":
	 			if(document.tambah_kosan.harga_termahal.value.length > limitHarga ) {
		     	alert('Harga terlalu panjang! Maksimal '+limitHarga+' karakter.');
		      }

	 			break;
	 		case "jalan":
	 			if(document.tambah_kosan.lokasi.value.length > limitJalan ) {
		     	alert('Jalan terlalu panjang! Maksimal '+limitJalan+' karakter.');
		      }

	 			break;
	 		case "nama_pemilik":
	 			if(document.tambah_kosan.nama_pemilik.value.length > limitNamaPemilik ) {
		     	alert('Nama pemilik terlalu panjang! Maksimal '+limitNamaPemilik+' karakter.');
		      }

	 			break;
	 		case "no_tlp":
	 			if(document.tambah_kosan.no_tlp.value.length > limitNomorTlp ) {
		     	alert('Nomor telepon terlalu panjang! Maksimal '+limitNomorTlp+' karakter.');
		      }

	 			break;
	 		case "deskripsi_fasilitas":
	 			if(document.tambah_kosan.deskripsi_fasilitas.value.length > limitFasilitas ) {
		     	alert('Deskripsi fasilitas terlalu panjang! Maksimal '+limitFasilitas+' karakter.');
		      }

	 			break;
	 		case "deskripsi_kondisi":
	 			if(document.tambah_kosan.deskripsi_kondisi.value.length > limitKondisi ) {
		     	alert('Deskripsi kondisi terlalu panjang! Maksimal '+limitKondisi+' karakter.');
		      }

	 			break;
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
			<div class="content-bar background-tambahkosan">
				<div class="single-page">
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
						$subPath = "images/gambar_kosan/kosan".\Session::get('id')."/temp";
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
									<img  class="etalage_thumb_image" src="images/uploadlahgambar.png" />
									<img class="etalage_source_image" src="images/uploadlahgambar.png" />
								</a>
							</li>
							<?php }else{ ?>
							@foreach ($files as $image)
							
							<li>

								<img "thumb_image_width"="450" class="etalage_thumb_image" src="{{asset($subPath."/".$image)}}" />							
								
								<img class="etalage_source_image" src="{{asset($subPath.'/'.$image)}}"/>
								<div class="text-center">
								
								<?php if(count($files)>1){ ?>

								<a class="contact2 text-center" href="deleteimagetumb/{{$image}}">
									<input type="button" value="Hapus Gambar">
								</a>
								<?php } ?>
								</div>								
								
							</li>
							@endforeach
							<?php } ?>
							<div class="clearfix"></div>
						</ul>
						<div class="text-center contact2">
							{!! Form::open(array('url'=>'uploadgambar','method'=>'PATCH', 'visibility'=> 'hidden' ,'files'=>true)) !!}
				         	
				         	{!! Form::file('image') !!}
						  	<p class="errors">{{$errors->first('image')}}</p>
							@if(Session::has('error'))
							<p class="errors">{{ Session::get('error') }}</p>
							@endif
							{!! Form::submit('Unggah Gambar', array('class'=>'single-but','type'=>'submit')) !!}
					     	 {!! Form::close() !!}
						</div>
					</div>
					<div class="details-left-info">
						<div class="contact2">
						<?php if(count($files)==0){ ?>
						<div class="row">	
							<div class="speed-boats2 tambahkosan">
								<div class="col-md-6 boat-info kelola-kos">
									
									<div class="arrow nip2"></div>
									<h4 class = "tambah-kosan">Tahap 1 : Unggah foto tempat kos!</h4>
									<p> Pilihlah foto / gambar tempat kos Anda yang terbaru minimal satu gambar!</p>
										
								</div>
								<div class="clearfix"></div>
							</div>
							<br>
						</div>		
						<?php }else{ ?>
						<div class="row">	
							<div class="speed-boats2 tambahkosan">
								<div class="col-md-6 boat-info kelola-kos">
									
									<div class="arrow nip2"></div>
									<h4 class = "tambah-kosan">Tahap 2 : Isi form berikut!</h4>
									<p> Isi setap form dengan lengkap dan benar! Telitilah data yang Anda masukkan dengan seksama. Admin berwenang untuk menghapus akun Anda jika diketahui ada pihak lain yang merasa dirugikan akibat informasi Anda. Anda bisa melakukan edit data melalui halaman kelola kos.</p>
										
								</div>
								<div class="clearfix"></div>
							</div>
							<br>
						</div>		
							{!! Form::open(['class'=>'text-right','onsubmit'=>'return check()','name'=>'tambah_kosan',  'url'=>"checkdatakosan", 'method'=>'PATCH'])!!}
							<div id="kota" class="text-center deskripsi-middle "><h3 class="tambahkosan">Harga Pertahun</h3> </div>
							<div class="row">
								<div id="kota" class="col-md-2 deskripsi-middle"><span>&nbsp;&nbsp;Mulai &nbsp;&nbsp;&nbsp;  Rp :</span> </div>
								<div class="col-md-3 harga">
								<input type="text" onkeyup="update('harga_termurah');" id="harga_termurah" onblur="this.value=commaSeparateNumber(this.value)" class="text" value="Harga" name='harga_termurah' onfocus="if (this.value == 'Harga'){this.value = '';}" onblur="if (this.value == '') {this.value = 'Harga';}" required/>
								</div>
								<div id="kota" class="col-md-2 deskripsi-middle"><span>Hingga &nbsp;&nbsp;&nbsp;Rp :</span> </div>
								<div class="col-md-3 harga">
								<input  type="text"  onkeyup="update('harga_termahal');" id="harga_termahal" onblur="this.value=commaSeparateNumber(this.value)" class="text" value="Harga" name='harga_termahal' onfocus="if (this.value == 'Harga'){this.value = '';}" onblur="if (this.value == '') {this.value = 'Harga';}" required/>
								</div>
							</div>
							<br>

							<div id="kota" class="text-center deskripsi-middle "><h3 class="tambahkosan">Lokasi</h3> </div>
							<div class="row">
								<div class="col-md-3 deskripsi-middle"><span>Provinsi</span> </div>
								<div class="col-md-8"  >
									<select  name="provinsi"  onchange="reload()" id="provinsi">
									  <option value="Provinsi">Provinsi</option>
									  <option value="Aceh">Aceh</option>
									  <option value="Bali">Bali</option>
									  <option value="Bangka Belitung">Bangka Belitung</option>
									  <option value="Banten">Banten</option>
									  <option value="Bengkulu">Bengkulu</option>
									  <option value="Yogyakarta">Yogyakarta</option>
									  <option value="Jakarta">Jakarta</option>
									  <option value="Gorontalo">Gorontalo</option>
									  <option value="Jambi">Jambi</option>
									  <option value="Jawa Barat">Jawa Barat</option>
									  <option value="Jawa Tengah">Jawa Tengah</option>
									  <option value="Jawa Timur">Jawa Timur</option>
									  <option value="Kalimantan Barat">Kalimantan Barat</option>
									  <option value="Kalimantan Tengah">Kalimantan Tengah</option>
									  <option value="Kalimantan Selatan">Kalimantan Selatan</option>
									  <option value="Kalimantan Timur">Kalimantan Timur</option>
									  <option value="Kalimantan Utara">Kalimantan Utara</option>
									  <option value="Kepulauan Riau">Kepulauan Riau</option>
									  <option value="Lampung">Lampung</option>
									  <option value="Maluku">Maluku</option>
									  <option value="Maluku utara">Maluku utara</option>
									  <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
									  <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
									  <option value="Riau">Riau</option>
									  <option value="Sulawesi Utara">Sulawesi Utara</option>
									  <option value="Sulawesi Tengah">Sulawesi Tengah</option>
									  <option value="Sulawesi Selatan">Sulawesi Selatan</option>
									  <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
									  <option value="Sumatra Selatan">Sumatra Selatan</option>
									  <option value="Sumatra Utara">Sumatra Utara</option>
									  <option value="Sumatra Barat">Sumatra Barat</option>
									  <option value="Papua">Papua</option>
									  <option value="Papua Barat">Papua Barat</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div id="namakota" class="col-md-3 deskripsi-middle"><span>Kota</span> </div>
								<div class="col-md-8">
									<select id="listkota" name="kota">
									  <option value="Kota">Kota</option>
									</select>
								</div>
							</div>

							<div class="row">							
								<div class="col-md-3 deskripsi-middle"><span>Jalan</span> </div>
								<div class="col-md-8">
									<input type="text" onkeyup="update('jalan');"  class="text" value="Jalan" name='lokasi' onfocus="if (this.value == 'Jalan'){this.value = '';}" onblur="if (this.value == '') {this.value = 'Jalan';}" required/>
								</div>
							</div>
							<br>

							<div id="kota" class="text-center deskripsi-middle "><h3 class="tambahkosan">Deskripsi</h3> </div>
							<input type="text" class="text" onkeyup="update('nama_pemilik');"  value="Nama Pemilik" name='nama_pemilik' onfocus="if (this.value == 'Nama Pemilik'){this.value = '';}" onblur="if (this.value == '') {this.value = 'Nama Pemilik';}" required/>
							<input type="text" class="text" onkeyup="update('no_tlp');"  value="Nomor Telepon" name='no_tlp' onfocus="if (this.value == 'Nomor Telepon'){this.value = '';}" onblur="if (this.value == '') {this.value = 'Nomor Telepon';}" required/>
							
							<textarea value="Fasilitas" onkeyup="update('deskripsi_fasilitas');" name='deskripsi_fasilitas'  onfocus="if (this.value == 'Fasilitas'){this.value = '';}" onblur="if (this.value == '') {this.value = 'Fasilitas';}">Fasilitas</textarea>
							
							<textarea value="Kondisi" onkeyup="update('deskripsi_kondisi');" name='deskripsi_kondisi'  onfocus="if (this.value == 'Kondisi'){this.value = '';}" onblur="if (this.value == '') {this.value = 'Kondisi';}">Kondisi</textarea>
							

						<div class="single-but">
							<input type="submit"  value="Daftarkan"/>
						</div>
							{!!Form::close()!!}
						<?php } ?>
						</div>
	
					</div>

					<!-- 
							<button onclick="showUlasan()">ulasan</button>
 -->
					<div class="clearfix"></div>
				</div>

				
			</div>
		</div>
	</div>
	</div>




<SCRIPT language=JavaScript>


function changeNumber(){
    var hargaMurah = document.getElementById(harga_termurah).value;
    var hargaMahal = document.getElementById(harga_termahal).value;

      hargaMurah = hargaMurah.toString().replace(/,/g,'');
      hargaMahal = hargaMahal.toString().replace(/,/g,'');
      document.getElementById('harga_termurah').innerHTML = hargaMurah;
      document.getElementById('harga_termahal').innerHTML = hargaMahal;
      alert("Submit button clicked!");
        return true;
  };

function commaSeparateNumber(val){
      val = val.toString().replace(/,/g,'');
    
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    //document.getElementById('hargaBesar').innerHTML = val;
    return val;
  }
$('#elementID').focusout(function(){

  alert(commaSeparateNumber($(this).val()));
});


function reload()
	{
		var provinsi = document.getElementById('provinsi').value;
		//document.getElementById('listkota').innerHTML = provinsi;
		var kota = [];
		if(provinsi == "Bali"){
			 kota=["Denpasar"];		
		}else if(provinsi == "Bangka Belitung"){
			kota=["Pangkalpinang"];
		}else if(provinsi == "Banten"){
			kota = [ "Cilegon","Serang","Tangerang","Tangerang Selatan"];
		}else if(provinsi == "Bengkulu"){
			kota = [ "Bengkulu"];
		}else if(provinsi == "Yogyakarta"){
			kota = [ "Yogyakarta"];
		}else if(provinsi == "Jakarta"){
			kota = [ "Jakarta Barat","Jakarta Pusat","Jakarta Selatan","Jakarta Timur","Jakarta Utara"];
		}else if(provinsi == "Gorontalo"){
			kota = ["Gorontalo" ];
		}else if(provinsi == "Jambi"){
			kota = ["Jambi","Sungai Penuh" ];
		}else if(provinsi == "Jawa Barat"){
			kota = ["Bandung","Banjar","Bekasi", "Bogor","Cimahi","Cirebon","Depok","Sukabumi","Tasikmalaya"];
		}else if(provinsi == "Jawa Tengah"){
			kota = ["Magelang","Pekalongan","Purwokerto","Salatiga", "Semarang","Surakarta","Tegal" ];
		}else if(provinsi == "Jawa Timur"){
			kota = ["Batu","Blitar","Kediri", "Madiun","Malang","Mojokerto", "Pasuruan","Probolinggo","Surabaya",];
		}else if(provinsi == "Kalimantan Barat"){
			kota = ["Pontianak","Singkawang"];
		}else if(provinsi == "Kalimantan Tengah"){
			kota = [ "Palangkaraya"];
		}else if(provinsi == "Kalimantan Selatan"){
			kota = [ "Banjarbaru","Banjarmasin"];
		}else if(provinsi == "Kalimantan Timur"){
			kota = ["Balikpapan","Bontang","Samarinda" ];
		}else if(provinsi == "Kalimantan Utara"){
			kota = [ "Tarakan"];
		}else if(provinsi == "Kepulauan Riau"){
			kota = [ "Batam","Tanjungpinang"];
		}else if(provinsi == "Lampung"){
			kota = ["Bandar Lampung","Kotabumi","Liwa","Metro" ];
		}else if(provinsi == "Maluku"){
			kota = ["Ambon","Tual" ];
		}else if(provinsi == "Maluku utara"){
			kota = [ "Ternate","Tidore"];
		}else if(provinsi == "Aceh"){
			kota = ["Banda Aceh","Langsa","Lhokseumawe","Meulaboh","Sabang","Subulussalam"];
		}else if(provinsi == "Nusa Tenggara Barat"){
			kota = [ "Bima","Mataram"];
		}else if(provinsi == "Nusa Tenggara Timur"){
			kota = ["Kupang" ];
		}else if(provinsi == "Riau"){
			kota = ["Dumai","Pekanbaru"];
		}else if(provinsi == "Sulawesi Utara"){
			kota = ["Bitung" ,"Kotamobagu" ,"Manado" ,"Tomohon"  ];
		}else if(provinsi == "Sulawesi Tengah"){
			kota = [ "Palu" ];
		}else if(provinsi == "Sulawesi Selatan"){
			kota = [ "Makassar" ,"Palopo" ,"Parepare"];
		}else if(provinsi == "Sulawesi Tenggara"){
			kota = ["Bau-Bau" ,"Kendari"  ];
		}else if(provinsi == "Sumatra Selatan"){
			kota = ["Lubuklinggau" ,"Pagaralam" ,"Palembang" ,"Prabumulih" ];		
		}else if(provinsi == "Sumatra Utara"){
			kota = [ "Binjai","Medan" ,"Padang Sidempuan" ,"Pematangsiantar" ,"Sibolga" ,"Tanjungbalai","Tebingtinggi" ];
		}else if(provinsi == "Sumatra Barat"){
			kota = [ "Bukittinggi","Padang" ,"Padangpanjang" ,"Pariaman" ,"Payakumbuh" ,"Sawahlunto" ,"Solok" ];
		}else if(provinsi == "Papua"){
			kota = [ "Jayapura" ];
		}else if(provinsi == "Papua Barat"){
			kota = [ "Sorong" ];
		}else{
			kota = [ "Kota" ];
		}

		var txt ="";
		for (i = 0; i < kota.length; i++) { 
			txt += "<option value=\""+kota[i]+"\">"+kota[i]+"</option>";
		}
		document.getElementById("listkota").innerHTML = txt;
	}
</script>
	@stop