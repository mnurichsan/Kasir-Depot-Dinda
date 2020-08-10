<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::group(['middleware'=>'auth'],function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('/barang','barangController');
    Route::resource('/pegawai','pegawaiController');
    Route::resource('/setoran','setoranController');
    Route::resource('/transaksi','transaksiController');
    Route::resource('/user','userController');
    Route::get('/transaksi/{kode}/{id}','transaksiController@show')->name('transaksi.show');
    Route::get('/data-laporan/transkasi','laporanController@transaksiIndex')->name('transaksi.laporan');
    Route::get('/data-laporan/transkasi/export-excel', 'laporanController@exportExcelTransaksi')->name('export.transaksi');
    Route::get('/data-laporan/setoran','laporanController@setoranIndex')->name('setoran.laporan');
    Route::get('/data-laporan/setoran/export-excel', 'laporanController@exportExcelSetoran')->name('export.setoran');

});