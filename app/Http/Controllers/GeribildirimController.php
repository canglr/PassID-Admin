<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Geribildirim;
use App\Kullanicilar;
use App\Cihazlar;

class GeribildirimController extends Controller
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
        $geribildirimler = Geribildirim::where('kategori', '=', 1)->orderBy('created_at', 'desc')->paginate(15);
        
        $bildirimsayisi = Geribildirim::where('kategori', '=', 1)->count();
        $bildirimokundusayisi = Geribildirim::where('kategori', '=', 1)->where('okundu', '=', false)->count();
        $arsivsayisi = Geribildirim::where('kategori', '=', 2)->count();
        $copsayisi = Geribildirim::where('kategori', '=', 3)->count();
        $yukseksayisi = Geribildirim::where('kategori', '=', 4)->count();
        $ortasayisi = Geribildirim::where('kategori', '=', 5)->count();
        $dusuksayisi = Geribildirim::where('kategori', '=', 6)->count();
        
        $sayilar = array($bildirimsayisi, $bildirimokundusayisi, $arsivsayisi, $copsayisi,$yukseksayisi,$ortasayisi,$dusuksayisi);
        
        if (request()->ajax()) {
            return response()->json(View('panel.geribildirim.geribildirim', array('geribildirimler' => $geribildirimler,'sayilar' => $sayilar))->render());
        }
        return View('panel.geribildirim.index', array('geribildirimler' => $geribildirimler,'sayilar' => $sayilar));
    }
    
    
    
    public function detay($id)
    {
        $id = decrypt($id);
        $geribildirim = Geribildirim::find($id);        
        $kullanici = Kullanicilar::find($geribildirim->kullanici_id); 
        $cihaz = Cihazlar::where('kullanici_id', '=', $geribildirim->kullanici_id)->where('PseudoID', '=', $geribildirim->PseudoID)->first();
        
        $geribildirimguncelleme = Geribildirim::find($id);
        $geribildirimguncelleme->okundu = true;
        $geribildirimguncelleme->save();
        
        return View('panel.geribildirim.detay', array('kullanici' => $kullanici,'geribildirim' => $geribildirim,'cihaz' => $cihaz));
    }
    
    public function bildirimkategori($id)
    {
        $id = (int)$id;
        $geribildirimler = Geribildirim::where('kategori', '=', $id)->orderBy('created_at', 'desc')->paginate(15);
        
        
        $bildirimsayisi = Geribildirim::where('kategori', '=', 1)->count();
        $bildirimokundusayisi = Geribildirim::where('kategori', '=', 1)->where('okundu', '=', false)->count();
        $arsivsayisi = Geribildirim::where('kategori', '=', 2)->count();
        $copsayisi = Geribildirim::where('kategori', '=', 3)->count();
        $yukseksayisi = Geribildirim::where('kategori', '=', 4)->count();
        $ortasayisi = Geribildirim::where('kategori', '=', 5)->count();
        $dusuksayisi = Geribildirim::where('kategori', '=', 6)->count();
        
        $sayilar = array($bildirimsayisi, $bildirimokundusayisi, $arsivsayisi, $copsayisi,$yukseksayisi,$ortasayisi,$dusuksayisi);
        
        
        if (request()->ajax()) {
            return response()->json(View('panel.geribildirim.geribildirim', array('geribildirimler' => $geribildirimler,'sayilar' => $sayilar))->render());
        }
        
    }
    
    
    public function ara($id)
    {
        //$id = decrypt($id);
        
        $bildirimsayisi = Geribildirim::where('kategori', '=', 1)->count();
        $bildirimokundusayisi = Geribildirim::where('kategori', '=', 1)->where('okundu', '=', false)->count();
        $arsivsayisi = Geribildirim::where('kategori', '=', 2)->count();
        $copsayisi = Geribildirim::where('kategori', '=', 3)->count();
        $yukseksayisi = Geribildirim::where('kategori', '=', 4)->count();
        $ortasayisi = Geribildirim::where('kategori', '=', 5)->count();
        $dusuksayisi = Geribildirim::where('kategori', '=', 6)->count();
        $sayilar = array($bildirimsayisi, $bildirimokundusayisi, $arsivsayisi, $copsayisi,$yukseksayisi,$ortasayisi,$dusuksayisi);
        
        
        $kullanici = Kullanicilar::where('mail', '=', $id)->first();
        $geribildirimler = Geribildirim::where('kullanici_id', '=', $kullanici->id)->orderBy('created_at', 'desc')->paginate(85);
        return response()->json(View('panel.geribildirim.geribildirim', array('geribildirimler' => $geribildirimler,'sayilar' => $sayilar))->render());
    }
    
    public function kategorisec($id,$kategori)
    {
        $id = decrypt($id);
        $kategori = decrypt($kategori);
        
        $geribildirim = Geribildirim::find($id);
        $geribildirim->kategori = $kategori;
        $geribildirim->save();
        $sonuc = array('islem' => 'Tamam');
        return $sonuc;
    }
    
    
    public function bildirimara($id)
    {
        //$id = decrypt($id);
        $bildirimsayisi = Geribildirim::where('kategori', '=', 1)->count();
        $bildirimokundusayisi = Geribildirim::where('kategori', '=', 1)->where('okundu', '=', false)->count();
        $arsivsayisi = Geribildirim::where('kategori', '=', 2)->count();
        $copsayisi = Geribildirim::where('kategori', '=', 3)->count();
        $yukseksayisi = Geribildirim::where('kategori', '=', 4)->count();
        $ortasayisi = Geribildirim::where('kategori', '=', 5)->count();
        $dusuksayisi = Geribildirim::where('kategori', '=', 6)->count();
        $sayilar = array($bildirimsayisi, $bildirimokundusayisi, $arsivsayisi, $copsayisi,$yukseksayisi,$ortasayisi,$dusuksayisi);
        
        $geribildirimler = Geribildirim::where('kisaid', '=', $id)->orderBy('created_at', 'desc')->paginate(85);
        return response()->json(View('panel.geribildirim.geribildirim', array('geribildirimler' => $geribildirimler,'sayilar' => $sayilar))->render());
    }
    
    
    public function mesajlar()
    {
        
        $mesajlar = Geribildirim::where('kategori', '=', 1)->take(3)->orderBy('created_at', 'desc')->get();        
        return View('panel.geribildirim.mesajlar', array('mesajlar' => $mesajlar));
    }
    
    
}
