<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class DogrulamaKontrol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
    
    
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            //Bu kısımda giriş yapan kullanıcımızın bilgilerini alıyoruz
           
            $dogrulama = session('dogrulama');
            if($dogrulama)
            {
               
                return $next($request);
            }
            // Değilse geldiği sayfaya geri atıyor.
            return redirect('panel/Dogrulama');
        }
        
        //return $next($request);
    }
    
    
}
