@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Doğrulama Kodu 
                
                
                            
                                <button id="dogrulamagonder" onclick="kodgonder()" type="button" class="btn btn-primary btn-xs">
                                  Gönder
                                </button>
                           
                      
                        
                        
                </div>

                <div class="panel-body">
                    
                    <div  class="form-horizontal">
                       

                        <div class="form-group">
                            <label for="kod" class="col-md-4 control-label">Kod</label>

                            <div class="col-md-6">
                                <input id="kod" type="text" name="kod" class="form-control">

                               
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button onclick="dogrula()" id="dogrula" type="button" class="btn btn-primary">
                                  Doğrula
                                </button>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




@section('js')
<script>

function dogrula() {

	var kod = document.getElementById("kod").value;
	
	
    
	$.ajax({
		  url: "/panel/Dogrula",
		  method: "POST",
		  data: { kod: kod},
		  
		}).done(function(response) {
			

			if(response.kod == 0)
			{
    			basarisiz("Başarısız",response.sonuc)
    		}else if(response.kod == 1)
    		{
    			basarili("Başarılı",response.sonuc)
    			setInterval(function(){
    				window.location.href = "/panel/Anasayfa";
        			}, 1500);			
    			  
        	}else{

            }
  		  
		}).fail(function( jqXHR, textStatus ) {
			basarisiz("Başarısız","Bilinmeyen durum")
		});
	
}



function kodgonder() {

	
	$.ajax({
		  url: "/panel/Kodgonder",
		  method: "POST",		 
		  
		}).done(function(response) {
			

			if(response.kod == 0)
			{
    			basarisiz("Başarısız",response.sonuc)
    		}else if(response.kod == 1)
    		{
    			basarili("Başarılı",response.sonuc)			
                          
        	}else{

            }
  		  
		}).fail(function( jqXHR, textStatus ) {
			basarisiz("Başarısız","Bilinmeyen durum")
		});
	
}



</script>
@endsection


