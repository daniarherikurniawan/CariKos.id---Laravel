<?php namespace App\Http\Controllers;
use App\Kosan;
use App\User;
use App\Ulasan;
use DB;
use View;
use App\Searching;

class KosanController extends Controller {


	public function showListKosan()
	{
		\Session::put('active',"Daftar Tempat Kos");
		$arrayKosanTertentu = array();
		$jumlah_kos_terbaru = 12;
		$jumlah_kota_provinsi = 10;

		$arrayKosan = Kosan::orderBy('updated_at','desc')
				->take($jumlah_kos_terbaru)
			->get();

		//mengolah data untuk kosan berdasarkan lokasi kota
		$arrayDataLokasiKota = array();
		$arrayKota = DB::table('tempat_kos')
			->orderBy('updated_at','desc')
			->take($jumlah_kota_provinsi)
			->lists('kota');
		$arrayKota = array_count_values($arrayKota);
		arsort($arrayKota);
		foreach ($arrayKota as $kota=> $jumlah ) {
			array_push($arrayDataLokasiKota, array($kota,$jumlah));
		}

		//return $arrayDataLokasiKota;

		//mengolah data untuk kosan berdasarkan lokasi provinsi
		$arrayDataLokasiProvinsi = array();
		$arrayProvinsi = DB::table('tempat_kos')
			->orderBy('updated_at','desc')
			->take($jumlah_kota_provinsi)
			->lists('provinsi');
		$arrayProvinsi = array_count_values($arrayProvinsi);
		arsort($arrayProvinsi);
		foreach ($arrayProvinsi as $provinsi => $jumlah) {
			array_push($arrayDataLokasiProvinsi, array($provinsi,$jumlah));
		}

		//menghitung kosan terbaru
		$arrayDataKotaTerbaru = array();
		$arrayKota = DB::table('tempat_kos')
			->orderBy('updated_at','desc')
				->take($jumlah_kos_terbaru)
			->lists('kota');

			
		$arrayKota = array_unique ($arrayKota);
		foreach ($arrayKota as $kota) {
			$arrayId = array();
			foreach($arrayKosan as $kosan){
				if($kosan->kota == $kota){
					array_push($arrayId, $kosan->id);
				}
			}
			$temp = array();
			array_push($temp, $kota);
			array_push($temp, $arrayId);
			array_push($arrayDataKotaTerbaru, $temp);
		}

		//menghitung kosan by harga pertahun
		// harusnya bisa dihitung ketika mendaftarkan dikelompokkan a,b,c,d,e,f
		$arrayDataHarga = array();
		$prevHarga = 0;
		$arrayHarga = array(0,3000000,5000000,8000000,12000000,15000000);
		foreach ($arrayHarga as $harga) {
			$jumlah = 0;
			if($harga != 0){
				$temp = Kosan::where('harga_termahal','<=',$harga)
					->where('harga_termurah','>=',$prevHarga)
					->lists('id');
				$temp3 = Kosan::where('harga_termurah','<=',$prevHarga)
					->where('harga_termahal','>=',$prevHarga)
					->lists('id');
				$temp2 = Kosan::where('harga_termahal','>=',$harga)
					->where('harga_termurah','<=',$harga)
					->lists('id');
				array_push($arrayDataHarga,array_unique (array_merge($temp, $temp2, $temp3)));
			}

			$prevHarga = $harga;
		}
		
		$temp = Kosan::where('harga_termurah','>=',$prevHarga)->orWhere('harga_termahal','>=',$prevHarga)
					->lists('id');
		array_push($arrayDataHarga, $temp);
		
		//mengatur untuk menampikan list tertentu
		if(\Session::has('sorting')){
			$arrayId =\Session::get('arrayIdKosanForSorting');
			$arrayKosan = Kosan::find($arrayId);
			switch (\Session::get('sorting')) {
				case 'ulasan':
					$arrayKosan = $arrayKosan->sortByDesc('jumlah_ulasan');
					break;
				case 'pengunjung':
					$arrayKosan = $arrayKosan->sortByDesc('dilihat');
					break;
				case 'termurah':
					$arrayKosan = $arrayKosan->sortBy('harga_termurah');
					break;
				case 'termahal':
					$arrayKosan = $arrayKosan->sortByDesc('harga_termahal');
					break;
			}
			return view('listkosan')->with('arrayKosan',$arrayKosan)->with('arrayDataHarga',$arrayDataHarga)->with('arrayDataKotaTerbaru',$arrayDataKotaTerbaru)->with('arrayDataLokasiProvinsi',$arrayDataLokasiProvinsi)->with('arrayDataLokasiKota',$arrayDataLokasiKota)->with('sorting',\Session::get('sorting'));

		}else if(\Session::has('kota')){
			\Session::forget('arrayId');
			$arrayKosan = Kosan::where('kota',\Session::get('kota'))
				->get();
			\Session::forget('kota');
			return view('listkosan')->with('arrayKosan',$arrayKosan)->with('arrayDataHarga',$arrayDataHarga)->with('arrayDataKotaTerbaru',$arrayDataKotaTerbaru)->with('arrayDataLokasiProvinsi',$arrayDataLokasiProvinsi)->with('arrayDataLokasiKota',$arrayDataLokasiKota)->with('sorting','ulasan');
	
		}else if(\Session::has('provinsi')){
			\Session::forget('arrayId');
			$arrayKosan = Kosan::where('provinsi',\Session::get('provinsi'))
				->get();
			\Session::forget('provinsi');
			return view('listkosan')->with('arrayKosan',$arrayKosan)->with('arrayDataHarga',$arrayDataHarga)->with('arrayDataKotaTerbaru',$arrayDataKotaTerbaru)->with('arrayDataLokasiProvinsi',$arrayDataLokasiProvinsi)->with('arrayDataLokasiKota',$arrayDataLokasiKota)->with('sorting','ulasan');
	
		}else if(\Session::get('showListKosanTertentu')=='true'){
			// berdasarkan harga
			$id = \Session::get('arrayKosanId');
			if($id==""){
				$arrayKosanTertentu = null;
			}else{
				$arrayId =  explode('+', $id);
				foreach ($arrayId as $currId) {
					array_push($arrayKosanTertentu, Kosan::find($currId));
				}
			}
			\Session::put('showListKosanTertentu','false');
			return view('listkosan')->with('arrayKosan',$arrayKosanTertentu)->with('arrayDataHarga',$arrayDataHarga)->with('arrayDataKotaTerbaru',$arrayDataKotaTerbaru)->with('arrayDataLokasiProvinsi',$arrayDataLokasiProvinsi)->with('arrayDataLokasiKota',$arrayDataLokasiKota)->with('sorting','ulasan');
		}else{
			\Session::forget('arrayId');
			\Session::put('kategori','Lokasi Terbaru');
			return view('listkosan')->with('arrayKosan',$arrayKosan)->with('arrayDataHarga',$arrayDataHarga)->with('arrayDataKotaTerbaru',$arrayDataKotaTerbaru)->with('arrayDataLokasiProvinsi',$arrayDataLokasiProvinsi)->with('arrayDataLokasiKota',$arrayDataLokasiKota)->with('sorting','ulasan');
		}
	}

	public function showListKosanKota($id)
	{
		\Session::put('Selected',$id);
		return redirect('lokasi');
	}

	public function showListKosanProvinsi($id)
	{
		\Session::put('Selected',$id);
		return redirect('lokasi');
	}
	
	public function showListKosanTertentu($id)
	{
		\Session::put('showListKosanTertentu','true');
		return redirect('listkosan')->with('arrayKosanId',$id);
	}
	
	public function showListKosanRedirect()
	{
		$id = \Session::get('jenislokasi');

		if(\Session::has('Selected')){
		
			$namaLokasi = \Session::get('Selected');
			//return(dd($id));
			if($id == 'Kota'){
				$arrayKosan = Kosan::where('kota',$namaLokasi)->get();
			}else{
				$arrayKosan = Kosan::where('provinsi',$namaLokasi)->get();
			}
			//dd($arrayKosan);
			\Session::put('kategori',$namaLokasi);
			return view('listsemuakotadanprovinsi')->with('arrayKosan',$arrayKosan);
		}else{
			// masuk halaman awal per kota / per provinsi
			$array = array();
			if($id=="Kota"){
				$array = DB::table('tempat_kos')
					->orderBy('kota','asc')
					->lists('kota');
				\Session::put('jenislokasi',"Kota");
			}else {
				$array = DB::table('tempat_kos')
					->orderBy('provinsi','asc')
					->lists('provinsi');
				\Session::put('jenislokasi',"Provinsi");
			}
			$arrayDataLokasi = array();
			$array = array_count_values($array); 
			foreach ($array as $lokasi => $jumlah) {
				array_push($arrayDataLokasi, array($lokasi,$jumlah));
			}
			//return $arrayDataLokasi;
			\Session::put('arrayDataLokasi',$arrayDataLokasi);
			return view('listsemuakotadanprovinsi');
		}
	}

	public function showListKosanBerdasarLokasi($id)
	{
		\Session::put('jenislokasi',$id);
		return redirect('lokasi');
	}
	
	public function showListKosanKategori($kategori,$id)
	{
		if($id!=-1){
			if($kategori == "Kota"){
				\Session::put('kategori',"Kota ( ".$id." )");
				return redirect('listkosan')->with('kota',$id);
			}else if($kategori == "Provinsi"){
				\Session::put('kategori',"Provinsi ( ".$id." )");
				return redirect('listkosan')->with('provinsi',$id);
			}else{
				//return $id;
				$arrayId =  explode('+', $id);
				//untuk melakukan pencarian spesifik lokasi berdasarkan
				if($kategori!="Lokasi Terbaru"){
					\Session::put('arrayId',$arrayId);
				}else{
					\Session::forget('arrayId');
				}

				\Session::put('kategori',$kategori);
				return redirect('listkosan/'.$id)->with('arrayKosanId',$id);
			}
		}else{
			\Session::put('kategori',$kategori);
			return redirect('mencari');
		}
	}
	
	public function redirectDetailKosan($id)
	{
		\Session::put('id_detail',$id);
		return redirect('detailkosan');
	}

	public function showDetailKosan()
	{
		$kosan = Kosan::find(\Session::get('id_detail'));
		$kosan->dilihat = $kosan->dilihat + 1;
		$kosan->save(); 
		$arrayKosan = DB::table('tempat_kos')
			->where('kota',$kosan->kota)
			->where('id',"!=",$kosan->id)
			->get();

		$arrayIdPengulas = $kosan->id_pengulas;
		$arrayIdPengulas = explode(" ", $arrayIdPengulas);
		$arrayIdPengulas = array_filter($arrayIdPengulas);
		$ulasan = array();
		$arrayUlasan = array();

		$url = 'detailkosan';

		$ulasan = Ulasan::where('id_kosan',$kosan->id)->where('id_user',\Session::get('id'))->first();

		if(\Session::has('showUlasan')){
			\Session::forget('showUlasan');

			$arrayIdUlasan = $kosan->id_ulasan;
			$arrayIdUlasan = explode(" ", $arrayIdUlasan);
			$arrayIdUlasan = array_filter($arrayIdUlasan);
			$arrayUlasan = Ulasan::find($arrayIdUlasan);
		}


		if(in_array(\Session::get('id'), $arrayIdPengulas)){
			//return $ulasan;
			return view('detailkosan',compact('kosan'))->with('arrayKosan',$arrayKosan)->with('ulasan',$ulasan)->with('arrayUlasan',$arrayUlasan);
		}else{
			return view('detailkosan',compact('kosan'))->with('arrayKosan',$arrayKosan)->with('ulasan',$ulasan)->with('arrayUlasan',$arrayUlasan);
		}
	}

	public function showListKosanSaya()
	{
		$arrayKosan = DB::table('tempat_kos')
			->where('id_pemilik', \Session::get('id'))
			->get();
		return view('listkosansaya',compact('arrayKosan'))->with('active',"Kelola Kos Anda");
	}
	public function showTambahKosan()
	{
		return view('tambahkosan');
	}

	public function deleteImageTumb($file)
	{
		try{
				
			$subPath = "images/gambar_kosan/kosan".\Session::get('id')."/temp";
			$path = dirname(dirname(dirname(__DIR__)))."/public/".$subPath.'/'.$file;
			
			unlink($path);

	        return redirect ("tambahkosan");
		}catch (\Exception $e) {

	        $url = "../tambahkosan";
        	$str = "Anda tidak bisa menghapus gambar tersebut!";
        	return view("status.failed",compact("str"),compact('url'));

		}
	}

	public function deleteImage($gambar)
	{
		try{
				
			$subPath = "images/gambar_kosan/kosan".\Session::get('id')."/".\Session::get('id_edited');
			$path = dirname(dirname(dirname(__DIR__)))."/public/".$subPath.'/'.$gambar;
			
			
				$files = array();
				$dir_path = dirname(dirname(dirname(__DIR__)))."/public/".$subPath;
				$directory = opendir($dir_path);
				

				while($file = readdir($directory)){
				    if($file !== '.' && $file !== '..'){
				    	$files[]= $file;
				        //echo '<img src="images/gambar_kosan/kosan'.\Session::get('id').'/'.$file.'" border="0" />';
				    }
				}
				if(count($files)>1){
					unlink($path);	
					if($gambar=="cover.jpg"){		
						
						rename(dirname(dirname(dirname(__DIR__)))."/public/images/gambar_kosan/kosan".\Session::get('id').'/'.\Session::get('id_edited').'/'.$files[0],dirname(dirname(dirname(__DIR__)))."/public/images/gambar_kosan/kosan".\Session::get('id')."/".\Session::get('id_edited')."/cover.jpg");
					}
					return redirect ("redirecteditkosan");
				}else{		
		            $url = "../redirecteditkosan";
	        		$str = "Gambar tempat kos minimal 1 foto!";
	        		return view("status.failed",compact("str"),compact('url'));
	        	}
		}catch (\Exception $e) {

	        $url = "../redirecteditkosan";
        	$str = "Anda tidak bisa menghapus gambar tersebut!";
        	return view("status.failed",compact("str"),compact('url'));

		}
	}
	

	public function deleteKosan($id)
	{
		try{
			$kosan = Kosan::where('id',$id)->where('id_pemilik',\Session::get('id'))
				->first();
				
			$subPath = "images/gambar_kosan/kosan".\Session::get('id')."/".$kosan->id;
			$path = dirname(dirname(dirname(__DIR__)))."/public/".$subPath;

			

			$directory = opendir($path);
			while($file = readdir($directory)){
			    if($file !== '.' && $file !== '..'){
			    	unlink($path.'/'.$file);
			        //echo '<img src="images/gambar_kosan/kosan'.\Session::get('id').'/'.$file.'" border="0" />';
			    }
			}
			$kosan->delete();
			rmdir($path);


	        $url = "../kosansaya";
	    	$str = "Anda berhasil menghapus tempat kos tersebut dari daftar.";
	    	return view("status.success",compact("str"),compact('url'));
		}catch (\Exception $e) {

	        $url = "../kosansaya";
        	$str = "Anda tidak bisa menghapus data tersebut!";
        	return view("status.failed",compact("str"),compact('url'));

		}
	}

	public function redirectEditKosan($id)
	{	
		\Session::put('id_edited',$id);
		return redirect('redirecteditkosan');
		
	}

	public function editKosan(){
		try{
			$kosan = DB::table('tempat_kos')
				->where('id_pemilik', \Session::get('id'))
				->where('id',\Session::get('id_edited'))
				->first();
			return view('editkosan',compact('kosan'));
		}catch (\Exception $e) {

	        $url = "kosansaya";
        	$str = "Anda tidak bisa mengedit data tersebut!";
        	return view("status.failed",compact("str"),compact('url'));

		}
	}

	public function upload() {
		//return dd(\Request::all());
		if(\Session::has('id')){
			if (($_FILES['image']['name'])!="") {
			   \Session::put('uploaded', "true");
				$nama_gambar = (\Request::file("image")->getClientOriginalName());
				$mime_type = (\Request::file("image")->getClientMimeType());
				$ekstensi = (\Request::file("image")->guessClientExtension());
				$path = (\Request::file("image")->getRealPath());

				\Request::file('image')->move(__DIR__.'/../'.'/../'.'/../'.'public/images/gambar_kosan/kosan'.\Session::get('id').'/temp',\Request::file('image')->getClientOriginalName());
				
				$subPath = "images/gambar_kosan/kosan".\Session::get('id')."/temp/".$nama_gambar;
		
				$new_path = dirname(dirname(dirname(__DIR__)))."/public/".$subPath;
				//dd($path);
				 list($width, $height)= getimagesize($new_path);

				 //crop
				 $image = imagecreatefromstring(file_get_contents($new_path));
				 $filename = dirname(dirname(dirname(__DIR__)))."/public/".$subPath;

				$thumb_width = 900;
				$thumb_height = 600;

				$original_aspect = $width / $height;
				$thumb_aspect = $thumb_width / $thumb_height;

				if ( $original_aspect >= $thumb_aspect )
				{
				   // If image is wider than thumbnail (in aspect ratio sense)
				   $new_height = $thumb_height;
				   $new_width = $width / ($height / $thumb_height);
				}
				else
				{
				   // If the thumbnail is wider than the image
				   $new_width = $thumb_width;
				   $new_height = $height / ($width / $thumb_width);
				}

				$thumb = imagecreatetruecolor( $thumb_width, $thumb_height );
				
				// Resize and crop
				imagecopyresampled($thumb,
				                   $image,
				                   0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
				                   0 - ($new_height - $thumb_height) / 2, // Center the image vertically
				                   0, 0,
				                   $new_width, $new_height,
				                   $width, $height);

				imagejpeg($thumb, $filename, 80);
				
				$str = $nama_gambar;
			}
				return redirect('tambahkosan');
		}else{
	        $url = "home#login";
        	$str = "Anda harus login untuk mengakses halaman tersebut!";
        	return view("status.failed",compact("str"),compact('url'));
		}
	}
	
	public function uploadForEdit() {
		//return dd(\Request::all());
		if(\Session::has('id')){
			if (($_FILES['image']['name'])!="") {
			   \Session::put('uploaded', "true");
				$nama_gambar = (\Request::file("image")->getClientOriginalName());
				$mime_type = (\Request::file("image")->getClientMimeType());
				$ekstensi = (\Request::file("image")->guessClientExtension());
				$path = (\Request::file("image")->getRealPath());

				\Request::file('image')->move(__DIR__.'/../'.'/../'.'/../'.'public/images/gambar_kosan/kosan'.\Session::get('id').'/'.\Session::get('id_edited'),\Request::file('image')->getClientOriginalName());
				
				$subPath = "images/gambar_kosan/kosan".\Session::get('id')."/".\Session::get('id_edited')."/".$nama_gambar;
		
				$new_path = dirname(dirname(dirname(__DIR__)))."/public/".$subPath;
				//dd($path);
				 list($width, $height)= getimagesize($new_path);

				 //crop
				 $image = imagecreatefromstring(file_get_contents($new_path));
				 $filename = dirname(dirname(dirname(__DIR__)))."/public/".$subPath;

				$thumb_width = 900;
				$thumb_height = 600;

				$original_aspect = $width / $height;
				$thumb_aspect = $thumb_width / $thumb_height;

				if ( $original_aspect >= $thumb_aspect )
				{
				   // If image is wider than thumbnail (in aspect ratio sense)
				   $new_height = $thumb_height;
				   $new_width = $width / ($height / $thumb_height);
				}
				else
				{
				   // If the thumbnail is wider than the image
				   $new_width = $thumb_width;
				   $new_height = $height / ($width / $thumb_width);
				}

				$thumb = imagecreatetruecolor( $thumb_width, $thumb_height );
				
				// Resize and crop
				imagecopyresampled($thumb,
				                   $image,
				                   0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
				                   0 - ($new_height - $thumb_height) / 2, // Center the image vertically
				                   0, 0,
				                   $new_width, $new_height,
				                   $width, $height);

				imagejpeg($thumb, $filename, 80);
				
				$str = $nama_gambar;
			}
				return redirect('redirecteditkosan');
		}else{
	        $url = "home#login";
        	$str = "Anda harus login untuk mengakses halaman tersebut!";
        	return view("status.failed",compact("str"),compact('url'));
		}
	}

	public function checkDataKosan() {
			//return dd(\Request::all());
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
		}catch (\Exception $e) {}

		if(count($files)!=0){

			$kosan = new Kosan;
			$kosan->id_pemilik = \Session::get('id');
			$kosan->lokasi = (\Request::get('lokasi'));

			$kosan->nama_pemilik = \Request::get('nama_pemilik');
			$kosan->no_tlp = (\Request::get('no_tlp'));
			$kosan->kota = (\Request::get('kota'));
			$kosan->provinsi = (\Request::get('provinsi'));

			$kosan->harga_termahal = str_replace(',','',(\Request::get('harga_termahal')));
			$kosan->harga_termurah = str_replace(',','',(\Request::get('harga_termurah')));
			$kosan->deskripsi_fasilitas = (\Request::get('deskripsi_fasilitas'));
			$kosan->deskripsi_kondisi = (\Request::get('deskripsi_kondisi'));
			$kosan->save();
			rename(dirname(dirname(dirname(__DIR__)))."/public/images/gambar_kosan/kosan".\Session::get('id').'/temp/'.$files[0],dirname(dirname(dirname(__DIR__)))."/public/images/gambar_kosan/kosan".\Session::get('id')."/temp/cover.jpg");
			rename(dirname(dirname(dirname(__DIR__)))."/public/images/gambar_kosan/kosan".\Session::get('id').'/temp',dirname(dirname(dirname(__DIR__)))."/public/images/gambar_kosan/kosan".\Session::get('id')."/".$kosan->id);
			

			$kosan = Kosan::find($kosan->id);

			
			$text = $kosan->toArray();
			$text = array_values($text);
			unset($text[0]); unset($text[1]);unset($text[4]); unset($text[12]);unset($text[13]);
			
			
			$text = implode (" ",$text);
			

			$text = preg_replace("/[^A-Za-z0-9 ]/", ' ', $text);

			$kw = utf8_encode(strtolower($text));
			$kw = preg_replace("/\b[^-]{0,1}\b/u", " ",  $kw);
			$text =  utf8_decode($kw);

			
			$text = explode(" ", $text);
			$text = array_filter($text);
			$text = array_unique($text);



			foreach ($text as $kata) {
				
				$idxSama = Searching::where('kata',$kata)->first();
				if($idxSama==null){
					$search = new Searching;
					$search->kata = $kata;
					$search->id_kosan = $kosan->id;
					$search->save();
				}else{
					$idxSama->id_kosan = $kosan->id." ".$idxSama->id_kosan;
					$idxSama->save();
				}
			}
			

			$url = "kosansaya";
	    	$str = "Anda berhasil menambahkan kamar kos baru!";
	    	return view("status.success",compact("str"),compact('url'));
		}else{
	        $url = "tambahkosan";
        	$str = "Anda harus mengunggah gambar tempat kos!";
        	return view("status.failed",compact("str"),compact('url'));

		}
	}

	public function checkEditKosan() {
			$kosan = Kosan::find(\Session::get('id_edited'));
			$kosan->lokasi = (\Request::get('lokasi'));

			$kosan->nama_pemilik = \Request::get('nama_pemilik');
			$kosan->no_tlp = (\Request::get('no_tlp'));

			$kosan->harga_termurah = (\Request::get('harga_termurah'));
			$kosan->deskripsi_fasilitas = (\Request::get('deskripsi_fasilitas'));
			$kosan->deskripsi_kondisi = (\Request::get('deskripsi_kondisi'));
			$kosan->save();

			$url = "kosansaya";
	    	$str = "Anda berhasil mengedit kamar kos tersebut!";
	    	return view("status.success",compact("str"),compact('url'));
	}

	function Delete($path)
	{
	    if (is_dir($path) === true)
	    {
	        $files = array_diff(scandir($path), array('.', '..'));

	        foreach ($files as $file)
	        {
	            Delete(realpath($path) . '/' . $file);
	        }

	        return rmdir($path);
	    }

	    else if (is_file($path) === true)
	    {
	        return unlink($path);
	    }

	    return false;
	}




}
