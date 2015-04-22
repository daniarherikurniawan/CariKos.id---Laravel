
@extends("layouts.master")

<script src="js/jquery.min.js"></script>

</div>
</div>	
</div>

@section('content')
<div class="product">
	<div class="container">
		<div class="col-md-12 ctnt-bar cntnt">
			<div class="content-bar">
				<div class="single-page">
					<ul class="product-head">
						<div class="text-left ">
							<a type="button" href="{{ URL::previous() }}" class="text-left btn btn-btn btn-info">Back</a>
						</div>
						<div class="clear"> </div>
					</ul>
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
							<h3 class="text-center" >Deskripsi</h3>
							{!! Form::open(['class'=>'text-right','url'=>"", 'method'=>'PATCH'])!!}
							<div class="row">
								<div class="text-left col-md-4">
									<br>
									<p>Lokasi :</p>
								</div>
								<div class="col-md-8">
									<input type="text" class="text" value="{{$kosan->lokasi}}" name='lokasi' onfocus="if (this.value == 'Lokasi'){this.value = '';}" onblur="if (this.value == '') {this.value = 'Lokasi';}" readonly/>
								</div>
							</div>


							<div class="row">
								<div class="text-left col-md-4">
									<br>
									<p>Harga :</p>
								</div>
								<div class="col-md-8">
									<input type="text" class="text" value="{{$kosan->harga}}" name='harga' onfocus="if (this.value == 'Harga'){this.value = '';}" onblur="if (this.value == '') {this.value = 'Harga';}" readonly/>
								</div>
							</div>
							<div class="row">
								<div class="text-left col-md-4">
									<br>
									<p>Nama Pemilik :</p>
								</div>
								<div class="col-md-8">
									<input type="text" class="text" value="{{$kosan->nama_pemilik}}" name='nama_pemilik' onfocus="if (this.value == 'Nama Pemilik'){this.value = '';}" onblur="if (this.value == '') {this.value = 'Nama Pemilik';}" readonly/>
								</div>
							</div>
							<div class="row">
								<div class="text-left col-md-4">
									<br>
									<p>Nomor Telepon :</p>
								</div>
								<div class="col-md-8">
									<input type="text" class="text" value="{{$kosan->no_tlp}}" name='no_tlp' onfocus="if (this.value == 'Nomor Telepon'){this.value = '';}" onblur="if (this.value == '') {this.value = 'Nomor Telepon';}" readonly/>
								</div>
							</div>
							<div class="row">
								<div class="text-left col-md-4">
									<br>
									<p>Fasilitas :</p>
								</div>
								<div class="col-md-8">
									<textarea name='deskripsi_fasilitas'  onfocus="if (this.value == 'Fasilitas'){this.value = '';}" readonly onblur="if (this.value == '') {this.value = 'Fasilitas';}">{{$kosan->deskripsi_fasilitas}} </textarea>
								</div>
							</div>
							<div class="row">
								<div class="text-left col-md-4">
									<br>
									<p>Deskripsi Kondisi :</p>
								</div>
								<div class="col-md-8">
									<textarea name='deskripsi_kondisi'  onfocus="if (this.value == 'Kondisi'){this.value = '';}"  readonly  onblur="if (this.value == '') {this.value = 'Kondisi';}">{{$kosan->deskripsi_kondisi}} </textarea>
								</div>
							</div>
							
						</div>

					</div>

					



					<div class="clearfix"></div>
				</div>

				
			</div>
		</div>

	</div>
	</div>
	@stop