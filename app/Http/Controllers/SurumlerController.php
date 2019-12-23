<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Surum;



class SurumlerController extends Controller
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
        
        $surumler = Surum::orderBy('created_at', 'desc')->paginate(15);
        if (request()->ajax()) {
            return response()->json(View('panel.surumler.surumler', array('surumler' => $surumler))->render());
        }
        return View('panel.surumler.index', array('surumler' => $surumler));
        
        //return view('panel.kullanicilar.index');
    }  
    
    
    
    public function surumkaydet(Request $request)
    {
        
        $surumkodu = $request->input('surumkodu');
        $surumdurumu = $request->input('surumdurumu');
        $surumdurumu = (bool) $surumdurumu;
        $surumsayisi = Surum::where('SurumKodu', '=',$surumkodu)->count();
        
        
        if($surumsayisi > 0)
        {
            $sonuc = array("sonuc" => "Aynı sürüm kodu zaten var.", "kod" => 0);
        }
        else if(strlen($surumkodu) == 0)
        {
            $sonuc = array("sonuc" => "Sürüm kodu boş bırakılamaz.", "kod" => 0);
        }
        else{
            
            $surum = new Surum();
            $surum->SurumKodu = $surumkodu;
            $surum->SurumDurumu = (bool) $surumdurumu;
            $surum->save();
            $sonuc = array("sonuc" => "Sürüm kaydedildi.","kod" => 1);
            
        }
        
       
        return response()->json($sonuc);
    }
    
    
    
    public function surumgetir(Request $request)
    {
        
        $id = $request->input('id');
        
        $id = decrypt($id);
        
        $surum = Surum::find($id);
        
        if($surum != null)
        {
            $surumdurumu = (int) $surum->SurumDurumu;
            $sonuc = array("SurumKodu" => $surum->SurumKodu,"SurumDurumu" => $surumdurumu,"kod" => 1,"surumid" => encrypt($surum->id));
        }else{
            $sonuc = array("sonuc" => "Veri Getirilemedi !", "kod" => 0);
        }
        
        
        
        return response()->json($sonuc);
    }
    
    
    
    
    
    public function surumguncelle(Request $request)
    {
        $id = $request->input('surumid');        
        $id = decrypt($id);
       
        $surumdurumu = $request->input('surumdurumu');
        $surumdurumu = (bool) $surumdurumu;
        
            
            $surum = Surum::find($id);
            $surum->SurumDurumu = (bool) $surumdurumu;
            $surum->save();
            $sonuc = array("sonuc" => "Sürüm güncellendi.","kod" => 1);
            
      
        
        
        return response()->json($sonuc);
    }
    
    
    
  
    
}
