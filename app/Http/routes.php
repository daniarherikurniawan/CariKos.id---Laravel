<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('', 'HomeController@home');
Route::get('home', 'HomeController@home');
Route::get('aboutUs', 'HomeController@aboutUs');
Route::get('redirecthome', 'HomeController@redirectHome');
Route::get('help', 'HomeController@help');
Route::get('login', 'HomeController@login');
Route::patch('login', 'HomeController@checkLogin');
Route::get('logout', 'HomeController@logout');
Route::patch('signup', 'HomeController@checkSignup');
Route::get('editakun', 'HomeController@showEditAkun');
Route::patch('checkupdate', 'HomeController@checkUpdateaAkun');
Route::patch('mencari', 'HomeController@startSearching');
Route::get('mencari', 'HomeController@searching');
Route::patch('urutkan', 'HomeController@startMengurutkan');


Route::get('lokasi', 'KosanController@showListKosanRedirect');
Route::get('Kota/{id}', 'KosanController@showListKosanKota');
Route::get('Provinsi/{id}', 'KosanController@showListKosanProvinsi');
Route::get('kosansaya', 'KosanController@showListKosanSaya');
Route::get('listkosan', 'KosanController@showListKosan');
Route::get('lokasi/{id}', 'KosanController@showListKosanBerdasarLokasi');
Route::get('tambahkosan', 'KosanController@showTambahKosan');
Route::get('deletekosan/{id}', 'KosanController@deleteKosan');
Route::get('kota/{id}', 'KosanController@showListKotaTertentu');
Route::get('provinsi/{id}', 'KosanController@showListProvinsiTertentu');
Route::get('listkosan/{kategori}/{id}', 'KosanController@showListKosanKategori');
Route::get('listkosan/{id}', 'KosanController@showListKosanTertentu');
Route::get('editkosan/{id}', 'KosanController@redirectEditKosan');
Route::get('tambahkosan', 'KosanController@showTambahKosan');
Route::patch('uploadgambar', 'KosanController@upload');
Route::get('redirecteditkosan', 'KosanController@EditKosan');
Route::get('deleteimagetumb/{file}', 'KosanController@deleteImageTumb');
Route::get('deleteimage/{file}', 'KosanController@deleteImage');
Route::patch('uploadgambaredit', 'KosanController@uploadForEdit');
Route::patch('checkdatakosan', 'KosanController@checkDataKosan');
Route::get('redirectdetailkosan/{id}', 'KosanController@redirectDetailKosan');
Route::patch('checkeditkosan', 'KosanController@checkEditKosan');
Route::get('detailkosan', 'KosanController@showDetailKosan');


Route::patch('kirimulasan', 'UlasanController@simpanUlasan');
Route::get('bacaulasan','UlasanController@showBacaUlasan');