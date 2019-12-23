<?php
namespace App\Http\Controllers;
use App\Mail;
use App\Paneldogrulama;
use Auth;

function mailgonder($mailadresi,$baslik,$mesaj,$sablon) {
	
    $mail = new Mail;
    $mail->mailadresi = $mailadresi;
    $mail->baslik = $baslik;
    $mail->mesaj = $mesaj;
    $mail->sablon = $sablon;
    $mail->durum = false;
    $mail->save();
}


function ipadresi() {    
    $ipadresi = (isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:$_SERVER['REMOTE_ADDR']);
    return $ipadresi;
}

function kodolustur() {
    $random = rand(10000000,99999999);
    return $random;    
}

function sureolustur($dakika) {
   $sure = time() + ($dakika*60);
   return $sure;
}

function dogrulamaolustur() {
    $dogrulama =  Paneldogrulama::where('kullanici_id', '=', Auth::user()->id)->where('sonkullanimtarihi', '>=', time())->where('durum', '=', false)->orderBy('id', 'desc')->first();
    
    if($dogrulama != null)
    {
        $mesaj="Tek kullanımlık doğrulama kodunuz aşağıdadır.<br>KOD: ".$dogrulama->dogrulamakodu."<br>IP: ".ipadresi()."<br>TARİH: ".date('d.m.Y H:i:s')."(UTC)";
        mailgonder(Auth::user()->email,"Doğrulama Kodu",$mesaj,"mail.bildirimmail");
        return true;
    }else{
        $kod = kodolustur();
        $dogrulama = new Paneldogrulama;
        $dogrulama->kullanici_id = Auth::user()->id;
        $dogrulama->dogrulamakodu = $kod;
        $dogrulama->durum = false;
        $dogrulama->sonkullanimtarihi = sureolustur(5);
        $dogrulama->save(); 
        $mesaj="Tek kullanımlık doğrulama kodunuz aşağıdadır.<br>KOD: ".$kod."<br>IP: ".ipadresi()."<br>TARİH: ".date('d.m.Y H:i:s')."(UTC)";
        mailgonder(Auth::user()->email,"Doğrulama Kodu",$mesaj,"mail.bildirimmail");
        return true;
    }    
    
    
}

function dogrulamasistemi($kod) {
    $dogrulama =  Paneldogrulama::where('kullanici_id', '=', Auth::user()->id)->where('sonkullanimtarihi', '>=', time())->where('dogrulamakodu', '=', $kod)->where('durum', '=', false)->first();
    if($dogrulama != null)
    {
        $dogrulama = Paneldogrulama::find($dogrulama->id);        
        $dogrulama->durum = true;        
        $dogrulama->save(); 
        session(['dogrulama'=>true]);
        return true;
    }else
    {
        return false;
    }
}

