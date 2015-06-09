<?php namespace App\Http\Controllers;
use App\Kosan;
use App\User;
use App\Ulasan;
use DB;
use View;
use App\Searching;

class UlasanController extends Controller {

	public function simpanUlasan(){
		
		$ulasan = new Ulasan;
		$ulasan->judul_ulasan = \Request::get('judul_ulasan');
		$ulasan->isi_ulasan = \Request::get('isi_ulasan');
        $url = "redirectdetailkosan/".\Session::get('id_detail');
		
		if($ulasan->judul_ulasan == "Judul Ulasan" || $ulasan->isi_ulasan == "Isi Ulasan"){
        	$str = "Ulasan tidak berhasil disimpan. Judul dan isi ulasan harus diisi!";
        	return view("status.failed",compact("str"),compact('url'));
		}else{
			$kosan = Kosan::find(\Session::get('id_detail'));
			$arrayIdPengulas = $kosan->id_pengulas;
			$arrayIdPengulas = explode(" ", $arrayIdPengulas);
			$arrayIdPengulas = array_filter($arrayIdPengulas);

			if(in_array(\Session::get('id'), $arrayIdPengulas)==false){
				$user = User::find(\Session::get('id'));
				$ulasan->nama_user = $user->nama;
				$ulasan->id_user = $user->id;
				$ulasan->id_kosan = $kosan->id;
				$ulasan->save();

				$ulasan = Ulasan::where('id_user',$user->id)
					->where('id_kosan',$kosan->id)->first();
				$kosan->jumlah_ulasan = $kosan->jumlah_ulasan + 1;
				$kosan->id_ulasan = $kosan->id_ulasan.$ulasan->id." ";
				$kosan->id_pengulas = $kosan->id_pengulas.$user->id." "; 
				$kosan->save();
	        	$str = "Anda berhasil menambahkan ulasan!";
	        	return view("status.success",compact("str"),compact('url'));
			}else {
	        	$str = "Anda hanya bisa memberikan ulasan satu kali untuk setiap tempat kos!";
	        	return view("status.failed",compact("str"),compact('url'));
			}
		}
	}

	public function showBacaUlasan(){
		\Session::put('showUlasan','true');
		return redirect('detailkosan#ulasan');
	}



} ?>