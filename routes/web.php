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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/panel/Anasayfa', 'AnasayfaController@index');
Route::get('/panel/api/toplam', 'AnasayfaController@toplam');
Route::get('/panel/api/cevrimici', 'AnasayfaController@cevrimici');
Route::get('/panel/api/mesajsayisi', 'AnasayfaController@mesajsayisi');

Route::get('/panel/Kullanicilar', 'KullanicilarController@index');

Route::get('/panel/Kullanicilar/detay/{id}', 'KullanicilarController@detay');

Route::get('/panel/Kullanicilar/detay/cihaz/{id}', 'KullanicilarController@detaycihaz');

Route::get('/panel/Kullanicilar/detaysayfalama/{id}/{tip}', 'KullanicilarController@detaysayfalama');

Route::get('/panel/Kullanicilar/profil/fotograf/{id}/{size}', 'KullanicilarController@profilfotograf');

Route::get('/panel/Kullanicilar/ara/{id}', 'KullanicilarController@ara');

Route::get('/panel/Kullanicilar/oturumsonlandir/{id}', 'KullanicilarController@oturumsonlandir');

Route::get('/panel/Geribildirim', 'GeribildirimController@index');

Route::get('/panel/Geribildirim/detay/{id}', 'GeribildirimController@detay');

Route::get('/panel/Geribildirim/kategori/{id}', 'GeribildirimController@bildirimkategori');

Route::get('/panel/Geribildirim/ara/{id}', 'GeribildirimController@ara');

Route::get('/panel/Geribildirim/kategorisec/{id}/{kategori}', 'GeribildirimController@kategorisec');

Route::get('/panel/Geribildirim/bildirimara/{id}', 'GeribildirimController@bildirimara');

Route::get('/panel/Geribildirim/mesajlar', 'GeribildirimController@mesajlar');

Route::post('/panel/Sifredegistir', 'PanelController@sifredegistir');

Route::get('/panel/Surumler', 'SurumlerController@index');

Route::post('/panel/Surumler/kaydet', 'SurumlerController@surumkaydet');

Route::post('/panel/Surumler/surumgetir', 'SurumlerController@surumgetir');

Route::post('/panel/Surumler/guncelle', 'SurumlerController@surumguncelle');

Route::get('/panel/Dogrulama', 'DogrulamaController@index');

Route::post('/panel/Dogrula', 'DogrulamaController@dogrula');

Route::post('/panel/Kodgonder', 'DogrulamaController@kodgonder');


