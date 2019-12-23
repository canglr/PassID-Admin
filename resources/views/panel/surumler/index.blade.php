@extends('panel.tema.tema')

@section('baslik','Sürümler')

@section('icerik')

<div class="surumler">
@include('panel.surumler.surumler')
</div>



<div class="modal fade" id="modal-yenisurum">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Yeni Sürüm</h4>
              </div>
              <div style="background-color:#ecf0f5;" class="modal-body">
                <div id="modal-icerik">
                
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-code-fork"></i></span>
                <input type="text" id="surumkodu" class="form-control" placeholder="Sürüm Kodu">                
  				</div></br>
  				
  				
  				<div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                <select id="surumdurumu" class="form-control">
  					<option value="1">Açık</option>
  					<option value="0">Kapalı</option>  
				</select>
 			              
  				</div></br>
  				
                </div>
              </div>
              <div class="modal-footer">                
             	<button type="button" onclick="surumkaydet()" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Kaydet</button>
                
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        
        
        
        
        <div class="modal fade" id="modal-surumguncelle">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Sürüm Güncelle</h4>
              </div>
              <div style="background-color:#ecf0f5;" class="modal-body">
                <div id="modal-icerik">
                <input type="hidden" id="surumid" disabled="disabled" class="form-control" placeholder="Sürüm Kodu">
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-code-fork"></i></span>
                <input type="text" id="surumkoduguncelleme" disabled="disabled" class="form-control" placeholder="Sürüm Kodu">                
  				</div></br>
  				
  				
  				<div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                <select id="surumdurumuguncelleme" class="form-control">
  					<option value="1">Açık</option>
  					<option value="0">Kapalı</option>  
				</select>
 			              
  				</div></br>
  				
                </div>
              </div>
              <div class="modal-footer">                
             	<button type="button" onclick="surumguncelle()" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Güncelle</button>
                
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>


@endsection

@section('js')

<script>


$(window).on('hashchange', function() {
    if (window.location.hash) {
        var page = window.location.hash.replace('#', '');
        if (page == Number.NaN || page <= 0) {
            return false;
        } else {               
        	surumgetPosts(page);
            }
        }      
});

$(document).ready(function() {

	$(document).on('click', '#surumler .pagination a', function (e) {
    	sayfa = $(this).attr('href').split('page=')[1];
    	surumgetPosts(sayfa);
        e.preventDefault();           
    });

	
});

function surumgetPosts(id) {
    $.ajax({
        url : '/panel/Surumler?page=' + id,
        dataType: 'json',
    }).done(function (data) {
        $('.surumler').html(data);
        location.hash = page;
    }).fail(function () {
    	basarisiz("Başarısız","veri getirilemedi !");
    });
}


function surumkaydet() {

    	var surumkodu = document.getElementById("surumkodu").value;
    	var surumdurumu = document.getElementById("surumdurumu").value;
    	
        
    	$.ajax({
    		  url: "/panel/Surumler/kaydet",
    		  method: "POST",
    		  data: { surumkodu: surumkodu,surumdurumu: surumdurumu},
    		  
    		}).done(function(response) {
    			

    			if(response.kod == 0)
    			{
        			basarisiz("Başarısız",response.sonuc)
        		}else if(response.kod == 1)
        		{
        			basarili("Başarılı",response.sonuc)
        			document.getElementById('surumkodu').value = "";
        			document.getElementById("surumdurumu").value = "true";
                              
            	}else{

                }
      		  
    		}).fail(function( jqXHR, textStatus ) {
    			basarisiz("Başarısız","Bilinmeyen durum")
    		});
    	
    }



function surumgetir(element) {

	var id = $(element).data("id");	
	
    
	$.ajax({
		  url: "/panel/Surumler/surumgetir",
		  method: "POST",
		  data: { id: id},
		  
		}).done(function(response) {
			

			if(response.kod == 0)
			{
    			basarisiz("Başarısız",response.sonuc)
    		}else if(response.kod == 1)
    		{
    			
    			document.getElementById('surumkoduguncelleme').value = response.SurumKodu;
    			document.getElementById("surumdurumuguncelleme").value = response.SurumDurumu;
    			document.getElementById("surumid").value = response.surumid;
                          
        	}else{

            }
  		  
		}).fail(function( jqXHR, textStatus ) {
			basarisiz("Başarısız","Bilinmeyen durum")
		});
	
}


function surumguncelle() {

	var surumid = document.getElementById("surumid").value;
	var surumdurumu = document.getElementById("surumdurumuguncelleme").value;
	
    
	$.ajax({
		  url: "/panel/Surumler/guncelle",
		  method: "POST",
		  data: { surumid: surumid,surumdurumu: surumdurumu},
		  
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


