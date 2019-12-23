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
use Session;

class DogrulamaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    
   
    public function index()
    {
        
        if(session('dogrulama'))
        {
            return redirect('/panel/Anasayfa');
        }else{
        dogrulamaolustur();    
        return View('auth.dogrulama');
        }
    }
    
    public function dogrula(Request $request)
    {
        $kod = $request->input('kod');
        
        if(dogrulamasistemi($kod))
        {
           return $sonuc = array("sonuc" => "Kimliğiniz doğrulandı.","kod" => 1); 
        }else{
           return $sonuc = array("sonuc" => "Geçersiz kod.","kod" => 0); 
        }
        
         
    }
    
    public function kodgonder(Request $request)
    {
        if(!session('dogrulama'))
        {          
       
        if(dogrulamaolustur()) 
        {
            return $sonuc = array("sonuc" => "Kod gönderildi.","kod" => 1); 
        }else{
            return $sonuc = array("sonuc" => "Sorun oluştu.","kod" => 0); 
        }
        
        }
        
    }
    
   
    
}
