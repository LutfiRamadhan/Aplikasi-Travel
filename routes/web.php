<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    // return view('welcome');
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard');
Route::resource('/transaksi', 'TransaksiController');
Route::get('/transaksi/{id}/tiket', 'TransaksiController@tiket');
Route::get('/transaksi/create/{id}', 'TransaksiController@create');
Route::resource('/jadwal', 'JadwalController');
Route::resource('/rute', 'RuteController');
Route::resource('/kendaraan', 'KendaraanController');
Route::resource('/karyawan', 'KaryawanController');