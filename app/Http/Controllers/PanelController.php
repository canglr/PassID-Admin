<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kullanicilar;
use App\Cihazlar;
use App\Girisler;
use App\Geribildirim;
use App\Mail;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
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
    
    
   
    public function sifredegistir(Request $request)
    {
        
        $mevcutsifre = $request->input('mevcutsifre');
        $yenisifre = $request->input('yenisifre');
        $yenisifretekrar = $request->input('yenisifretekrar');
        
        if (!(Hash::check($mevcutsifre, Auth::user()->password))) {
            // The passwords matches
            $sonuc = array("sonuc" => "Mevcut şifreniz, sağladığınız şifre ile eşleşmiyor. Lütfen tekrar deneyin.", "kod" => 0);   
            
        }        
        else if(strcmp($mevcutsifre, $yenisifre) == 0)
        {
            //Current password and new password are same
            $sonuc = array("sonuc" => "Yeni Şifre mevcut şifrenizle aynı olamaz. Lütfen farklı bir şifre seçin.","kod" => 0);   
            
        }        
        else if($yenisifre != $yenisifretekrar)
        {           
            $sonuc = array("sonuc" => " 'Yeni Şifre' ile 'Yeni şifre tekrar' alanları eşleşmiyor.","kod" => 0);  
            
        }
        else if(strlen($yenisifre) < 8 || strlen($yenisifretekrar) < 8)
        {
            $sonuc = array("sonuc" => " 'Yeni Şifre' ile 'Yeni şifre tekrar' alanları en az 8 karakterli olmalıdır","kod" => 0);
        }        
        else{
            $user = Auth::user();
            $user->password = Hash::make($yenisifre);
            $user->save();            
            $sonuc = array("sonuc" => "Şifre değiştirildi.","kod" => 1);   
            
            $bilgi= "Şifreniz ".date('d.m.Y H:i:s')."(UTC) tarihinde değiştirilmiştir. <br>IP:".ipadresi();
            
            mailgonder(Auth::user()->email,"Şifreniz değiştirildi !",$bilgi,"mail.bildirimmail");
            
        }
        
    
   	
    return response()->json($sonuc);
    }
    
   
    
}
