<?php namespace App\Http\Controllers;
use App\Kosan;
use App\User;
use DB;
class KosanController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function showListKosan()
	{
		\Session::put('active',"Daftar Tempat Kos");
		return view('listkosan');
	}

	public function showListKosanSaya()
	{
		\Session::put('active',"Kelola Kos Anda");
		$arrayKosan = DB::table('tempat_kos')
			->where('id_pemilik', \Session::get('id'))
			->get();
		return view('listkosansaya',compact('arrayKosan'));
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

			$kosan->harga = (\Request::get('harga'));
			$kosan->deskripsi_fasilitas = (\Request::get('deskripsi_fasilitas'));
			$kosan->deskripsi_kondisi = (\Request::get('deskripsi_kondisi'));
			$kosan->save();
			rename(dirname(dirname(dirname(__DIR__)))."/public/images/gambar_kosan/kosan".\Session::get('id').'/temp/'.$files[0],dirname(dirname(dirname(__DIR__)))."/public/images/gambar_kosan/kosan".\Session::get('id')."/temp/cover.jpg");
			rename(dirname(dirname(dirname(__DIR__)))."/public/images/gambar_kosan/kosan".\Session::get('id').'/temp',dirname(dirname(dirname(__DIR__)))."/public/images/gambar_kosan/kosan".\Session::get('id')."/".$kosan->id);
			
			$url = "kosansaya";
	    	$str = "Anda berhasil menambahkan kamar kos baru!";
	    	return view("status.success",compact("str"),compact('url'));
		}else{
	        $url = "tambahkosan";
        	$str = "Anda harus mengunggah gambar tempat kos!";
        	return view("status.failed",compact("str"),compact('url'));

		}
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
