<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kullanicilar;
use App\Cihazlar;
use App\Girisler;
use App\Geribildirim;
use DateTime;


class AnasayfaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('DogrulamaKontrol');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function index()
    {    	
        return view('panel.anasayfa.index');
    }
    
    public function toplam()
    {
    $kullanicisayisi = Kullanicilar::all()->count();  
    $cihazsayisi = Cihazlar::all()->count();  
    $toplam_json = array("kullanicisayisi" => $kullanicisayisi,"cihazsayisi" => $cihazsayisi);   	
    return response()->json($toplam_json);
    }
    
    public function cevrimici()
    {
    $baslangictarihix = gmdate("Y-m-d H:i:s", time()-40);    
    
    $baslangictarihi = DateTime::createFromFormat('Y-m-d H:i:s', $baslangictarihix);
	
    $cevrimicicihazsayisi = Girisler::where('updated_at', '>=', $baslangictarihi)->count();  
    $cevrimicikullanicisayisi = Girisler::where('updated_at', '>=', $baslangictarihi)->groupBy('kullanici_id')->get(['kullanici_id'])->count(); 
    $toplam_json = array("cevrimicicihazsayisi" => $cevrimicicihazsayisi,"cevrimicikullanicisayisi" => $cevrimicikullanicisayisi);   	
    return response()->json($toplam_json);
    }
    
    public function mesajsayisi()
    {
    $mesajsayisi = Geribildirim::where('kategori', '=', 1)->where('okundu', '=', false)->count();  
    
    $toplam_json = array("mesajsayisi" => $mesajsayisi);   	
    return response()->json($toplam_json);
    }
    
}
