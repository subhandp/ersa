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


Route::get('/login','AuthController@login')->name('login');
Route::post('/postlogin','AuthController@postlogin');
Route::get('/logout','AuthController@logout');

Route::group(['middleware' => ['auth','checkRole:admin,petugas']], function () {

    Route::get('/', function () {
        return view('/dashboard');
    });

    Route::get('/dashboard','DashboardController@index');

    Route::get('/suratmasuk','SuratMasukController@index');
    Route::get('/suratmasuk/index','SuratMasukController@index');
    Route::get('/suratmasuk/create','SuratMasukController@create');
    Route::post('/suratmasuk/tambah','SuratMasukController@tambah');
    Route::get('/suratmasuk/{id}/tampil','SuratMasukController@tampil');
    Route::get('viewAlldownloadfile','SuratMasukController@downfunc');
    Route::get('/suratmasuk/{id}/edit','SuratMasukController@edit');
    Route::post('/suratmasuk/{id}/update','SuratMasukController@update');
    Route::get('/suratmasuk/{id}/delete','SuratMasukController@delete');

    Route::get('/suratkeluar', 'SuratKeluarController@index');
    Route::get('/suratkeluar/index','SuratKeluarController@index');
    Route::get('/suratkeluar/create','SuratKeluarController@create');
    Route::post('/suratkeluar/tambah','SuratKeluarController@tambah');
    Route::get('/suratkeluar/{id}/tampil','SuratKeluarController@tampil');
    Route::get('viewAlldownloadfile','SuratKeluarController@downfunc');
    Route::get('/suratkeluar/{id}/edit','SuratKeluarController@edit');
    Route::post('/suratkeluar/{id}/update','SuratKeluarController@update');
    Route::get('/suratkeluar/{id}/delete','SuratKeluarController@delete');


    Route::get('/klasifikasi', 'KlasifikasiController@index');
    Route::get('/klasifikasi/index','KlasifikasiController@index');
    Route::get('/klasifikasi/create','KlasifikasiController@create');
    Route::post('/klasifikasi/tambah','KlasifikasiController@tambah');
    Route::get('/klasifikasi/{id}/edit','KlasifikasiController@edit');
    Route::post('/klasifikasi/{id}/update','KlasifikasiController@update');
    Route::get('/klasifikasi/{id}/delete','KlasifikasiController@delete');

    Route::post('/klasifikasi.import', 'KlasifikasiController@import');

    Route::get('disposisi/{suratmasuk}', 'DisposisiController@index')->name('disposisi.index');
    Route::post('disposisi/{suratmasuk}', 'DisposisiController@store')->name('disposisi.store');
    Route::get('disposisi/{suratmasuk}/create', 'DisposisiController@create')->name('disposisi.create');
    Route::get('disposisi/{suratmasuk}/{id}/edit', 'DisposisiController@edit')->name('disposisi.edit');
    Route::get('disposisi/{suratmasuk}/{id}', 'DisposisiController@update')->name('disposisi.update');
    Route::delete('disposisi/{suratmasuk}/{id}', 'DisposisiController@destroy')->name('disposisi.destroy');
    Route::get('/disposisi/{suratmasuk}/{id}/download', 'DisposisiController@download')->name('disposisi.download');

    Route::get('download/zip', 'DownloadController@zip')->name('download.zip');


});

Route::group(['middleware' => ['auth','checkRole:admin']], function () {
    Route::resource('/instansi','InstansiController');
    Route::resource('/pengguna','PenggunaController');
});

Route::group(['middleware' => ['auth','checkRole:admin,petugas']], function () {
    Route::post('filepond/process', 'FilepondController@process')->name('filepond.process');
    Route::get('filepond/getfile/{id}', 'FilepondController@getfile')->name('filepond.getfile');
    Route::delete('filepond/revert', 'FilepondController@revert')->name('filepond.revert');
    Route::get('filepond/remove/{requestid}', 'FilepondController@remove')->name('filepond.remove');

});
