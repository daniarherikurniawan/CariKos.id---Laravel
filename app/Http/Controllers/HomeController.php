<?php namespace App\Http\Controllers;
use App\User;
use DB;
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
		\Session::put('active',"Home");
		return redirect(("home"));
	}
	public function aboutUs()
	{
		\Session::put('active',"Tentang Kami");
		return redirect('home#aboutUs');
	}
	
	public function help()
	{
		\Session::put('active',"Bantuan");
		return redirect('home#help');
	}
	
	public function login()
	{
		\Session::put('active',"Login");
		return redirect('home#login');
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
	        	if($user->peran == "admin"){
	        		$str = $str." sebagai administrator.";
	        	}else{
	        		$str = $str."! Temukan dan daftarkan tempat kos terbaik anda!!";
	        	}
	        	$url = "home";
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

	public function logout()
	{
		\Session::put('active',"Logout");
		\Session::flush();
		return redirect('home');
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
