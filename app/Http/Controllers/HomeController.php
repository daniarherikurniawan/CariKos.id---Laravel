<?php namespace App\Http\Controllers;
use App\User;
use App\Kosan;
use DB;
use App\Searching;
class HomeController extends Controller {

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
	public function home()
	{
		return view("home");
	}
	public function redirectHome()
	{
		return redirect("home")->with('active',"Home");
	}
	public function aboutUs()
	{
		return redirect('home#aboutUs')->with('active',"Tentang Kami");
	}
	
	public function help()
	{
		return redirect('home#help')->with('active',"Bantuan");
	}
	
	public function login()
	{
		return redirect('home#login')->with('active',"Login");
	}
	public function checkLogin()
	{
		try{
			$user = DB::table('users')
	                    ->where('email', (\Request::get('email')))
	                    ->first();
	        $result =  strcmp($user->password,(\Request::get('password')));
	        if($result===0){
	        	\Session::put('id', $user->id);
	        	\Session::put('peran', $user->peran);
	        	\Session::put('nama', $user->nama);
				\Session::put('uploaded', "false");
	        	$str = "Selamat ".$user->nama.". Anda berhasil login";
	        	$str = $str."! Temukan dan daftarkan tempat kos terbaik anda!!";
	        	
	        	if(\Session::get('active')!="Daftar Tempat Kos"){
	        		$url = "kosansaya";
	        	}else{
	        		$url = "redirectdetailkosan/".\Session::get('id_detail');
	        	}
	        	return view("status.success",compact("str"),compact('url'));
	        }else{
	        	$url = "home#login";
	        	$str = "Anda tidak berhasil login. Cek kembali email dan password Anda!";
            	return view("status.failed",compact("str"),compact('url'));
		    }
		}catch (\Exception $e) {
	        $url = "home#login";
        	$str = "Anda Tidak Berhasil Login. Cek kembali email dan password Anda!";
        	return view("status.failed",compact("str"),compact('url'));
		}
	}

	public function startSearching()
	{
		if(\Request::get('query') == "Masukkan nama kota/ pemilik/ harga/ kata kunci lain"){
			\Session::put('query',"Kata kunci pencarian");
			return redirect('home');
		}else if(\Request::get('query') ==  "Nama Kota atau Provinsi"){
			\Session::put('query',"Kata kunci pencarian");
			return redirect('listkosan');
		}else if(\Request::get('query') ==  "Kata kunci pencarian"){
			\Session::put('query',"Kata kunci pencarian");
			return redirect('listkosan');
		}else{
			$text = \Request::get('query');

			$idKosan = "";
			if(\Session::has('arrayId')){
				// untuk mencari berdasarkan harga dan lokasi
				$arrayId = \Session::get('arrayId');

				foreach ($arrayId as $id) {
					$kosan = Kosan::find($id);
					$kota = strtolower($kosan->kota);
					$provinsi = strtolower($kosan->provinsi);
					if($kota == $text || $provinsi == $text ){
						if($idKosan==null){
							$idKosan = $kosan->id;
						}else{
							$idKosan = $idKosan."+".$kosan->id;
						}
					}
				}

				\Session::forget('arrayId');
				return redirect('listkosan')->with('showListKosanTertentu',"true")->with('arrayKosanId',$idKosan);
		
			}else{

				\Session::put('query',$text);

				$text = preg_replace("/[^A-Za-z0-9 ]/", ' ', $text);

				$kw = utf8_encode(strtolower($text));
				$kw = preg_replace("/\b[^-]{0,1}\b/u", " ",  $kw);
				$text =  utf8_decode($kw);

				$text = explode(" ", $text);
				$text = array_filter($text);
				$text = array_unique($text);

				foreach ($text as $kata) {
					$temp = Searching::where('kata',$kata)->first();
					if($temp!=null){
						$idKosan = $idKosan." ".$temp->id_kosan;
					}
				}
			}

			$idKosan = explode(" ", $idKosan);
			//return $idKosan;
			$idKosan = array_filter($idKosan);
			$idOccurence = array_count_values($idKosan);
			arsort($idOccurence);
			$idOccurence = array_keys($idOccurence);
			$idOccurence = implode("+", $idOccurence);
			return redirect('listkosan')->with('kategori', "Hasil Pencarian")->with('showListKosanTertentu',"true")->with('arrayKosanId',$idOccurence);
		}	
	}

	public function startMengurutkan()
	{
		switch (\Request::get('urutan')) {
			case 'Jumlah Ulasan':
				return redirect('listkosan')->with('sorting',"ulasan");
				break;
			case 'Jumlah Pengunjung':
				return redirect('listkosan')->with('sorting',"pengunjung");
				break;
			case 'Harga Termurah':
				return redirect('listkosan')->with('sorting',"termurah");
				break;
			case 'Harga Termahal':
				return redirect('listkosan')->with('sorting',"termahal");
				break;
		}
	}
	
public function searching()
	{
		$text = "";
		$idKosan = "";
		\Session::put('query',\Session::get('kategori'));

		$text = preg_replace("/[^A-Za-z0-9 ]/", ' ', $text);

		$kw = utf8_encode(strtolower($text));
		$kw = preg_replace("/\b[^-]{0,1}\b/u", " ",  $kw);
		$text =  utf8_decode($kw);

		$text = explode(" ", $text);
		$text = array_filter($text);
		$text = array_unique($text);

		foreach ($text as $kata) {
			$temp = Searching::where('kata',$kata)->first();
			if($temp!=null){
				$idKosan = $idKosan." ".$temp->id_kosan;
			}
		}
			

		$idKosan = explode(" ", $idKosan);
		//return $idKosan;
		$idKosan = array_filter($idKosan);
		$idOccurence = array_count_values($idKosan);
		arsort($idOccurence);
		$idOccurence = array_keys($idOccurence);
		$idOccurence = implode("+", $idOccurence);
		return redirect('listkosan')->with('kategori', "Hasil Pencarian")->with('showListKosanTertentu',"true")->with('arrayKosanId',$idOccurence);
		
	}

	public function logout()
	{
		\Session::flush();
		return redirect('home')->with('active',"Logout");
	}
	public function showEditAkun()
	{
		\Session::put('active',"Edit Akun");
		$user = DB::table('users')
                    ->where('id', (\Session::get('id')))
                    ->first();
		return view('account',compact('user'));
	}
	public function checkSignup(){
		try{
			$user = new User;
			$user->nama = (\Request::get('nama'));
			$user->email = (\Request::get('email'));
			$user->password = (\Request::get('password'));
			$user->save();
	        $url = "home";
        	$str = "Berhasil Mendaftarkan Akun";
        	return view("status.success",compact("str"),compact('url'));
        } catch (\Exception $e) {
	        $url = "home#login";
        	$str = "Gagal Mendaftarkan Akun";
        	return view("status.failed",compact("str"),compact('url'));
		}
	}

	public function checkUpdateaAkun(){
		try{
			 DB::table('users')
	            ->where('id', \Session::get('id'))
	            ->update(array('nama' => (\Request::get('nama')), 'email' => (\Request::get('email')),'password'=>(\Request::get('password'))));

	        $user = User::find(\Session::get('id'));
			\Session::forget('nama');
	    	\Session::put('nama', $user->nama);

			$str = "Berhasil Mengedit Akun";
			$url = "home";
			return view("status.success",compact("str"),compact('url'));
		}catch (\Exception $e) {
        	$str = "Maaf, akun berbeda harus menggunakan email yang berbeda";
        	$url = "editakun";
        	return view("status.failed",compact("str"),compact('url'));
		}
	}

















}
