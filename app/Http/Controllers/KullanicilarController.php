<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kullanicilar;
use App\Cihazlar;
use App\Girisler;
use App\Oturumlar;


class KullanicilarController extends Controller
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
        
        $kullanicilar = Kullanicilar::orderBy('created_at', 'desc')->paginate(20);
        if (request()->ajax()) {
            return response()->json(View('panel.kullanicilar.kullanicilar', array('kullanicilar' => $kullanicilar))->render());
        }
        return View('panel.kullanicilar.index', array('kullanicilar' => $kullanicilar));
        
        //return view('panel.kullanicilar.index');
    }
    
    
    public function detay($id)
    {
        $id = decrypt($id);
        $kullanici = Kullanicilar::find($id);
        $cihazsayisi = Cihazlar::where('kullanici_id', '=', $id)->count();
        $girissayisi = Girisler::where('kullanici_id', '=', $id)->count();
        $oturumsayisi = Oturumlar::where('kullanici_id', '=', $id)->count();
        
        $cihazlar = Cihazlar::where('kullanici_id', '=', $id)->orderBy('created_at', 'desc')->paginate(7);
        $girisler = Girisler::where('kullanici_id', '=', $id)->orderBy('created_at', 'desc')->paginate(7);
        $oturumlar = Oturumlar::where('kullanici_id', '=', $id)->orderBy('created_at', 'desc')->paginate(7);
       
        
        return View('panel.kullanicilar.detay', array('kullanici' => $kullanici,'cihazsayisi' => $cihazsayisi,'girissayisi' => $girissayisi,'oturumsayisi' => $oturumsayisi,'cihazlar' => $cihazlar,'girisler' => $girisler,'oturumlar' => $oturumlar));
    }
    
    
    public function detaycihaz($id)
    {
        $id = decrypt($id);
        $cihaz = Cihazlar::find($id);
        return View('panel.kullanicilar.detaycihaz', array('cihaz' => $cihaz));
    }
    
    public function detaysayfalama($id,$tip)    
    {
        $id = decrypt($id);
        
        $cihazlar = null;
        $girisler = null;
        $oturumlar = null;        
        
        
        if($tip == 1)
        {
        $cihazlar = Cihazlar::where('kullanici_id', '=', $id)->orderBy('created_at', 'desc')->paginate(7);
        }else if($tip == 2)
        {
        $girisler = Girisler::where('kullanici_id', '=', $id)->orderBy('created_at', 'desc')->paginate(7);
        }else if($tip == 3)
        {
        $oturumlar = Oturumlar::where('kullanici_id', '=', $id)->orderBy('created_at', 'desc')->paginate(7);
        }else{
            return null;
        }
        if (request()->ajax()) {
            return response()->json(View('panel.kullanicilar.detaysayfalama', array('cihazlar' => $cihazlar,'girisler' => $girisler,'oturumlar' => $oturumlar,'tip' => $tip))->render());
        }
    }
    
    public function profilfotograf($id,$size)
    {   
        $id = base64_decode($id);
        if (filter_var($id, FILTER_VALIDATE_EMAIL)) {
           
        } else {
            $kullanici = Kullanicilar::find($id);
            $id = $kullanici->mail;
        }
        
        
        $kullanici = Kullanicilar::find($id);
        
        $url = 'https://pikmail.herokuapp.com/'.$id.'?size='.$size;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $data = curl_exec($ch);
        curl_close($ch);   
        
        $json = json_decode($data);
        
        if ($json == false) { 
            header("Content-Type: image/jpeg");
            echo $data;
        }else{   
            $url = 'https://www.gravatar.com/avatar/'.md5($id).'?s=128';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            $data = curl_exec($ch);
            curl_close($ch);   
            header("Content-Type: image/jpeg");
            echo $data;
            
        }        
        
    }
    
    
    
    public function ara($id)
    {
        //$id = decrypt($id);
        $kullanicilar = Kullanicilar::where('mail', '=', $id)->paginate(20);
        return response()->json(View('panel.kullanicilar.kullanicilar', array('kullanicilar' => $kullanicilar))->render());
    }
    
    
    public function oturumsonlandir($id)
    {
        $id = decrypt($id);
        
        $oturum = Oturumlar::find($id);
        
        if($oturum->sonkullanimtarihi > time())
        {
           
             $oturumguncelleme = Oturumlar::find($id);
             $oturumguncelleme->sonkullanimtarihi = time();
             $oturumguncelleme->save();
            
            $sonuc_json = array("oturum" => 1);
        }else{
            $sonuc_json = array("oturum" => 0);
        }
        
       
        return response()->json($sonuc_json);
    }
    
    
    
}
