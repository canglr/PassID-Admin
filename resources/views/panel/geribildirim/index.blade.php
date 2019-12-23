@extends('panel.tema.tema')

@section('baslik','Geri Bildirim')

@section('icerik')


<div class="panel panel-default">
  <div class="panel-body">
   
   
   <div class="input-group col-md-4 pull-left">
                <span class="input-group-addon"><i class="fa fa-folder"></i></span>
                
                
                <select onchange="bildirimkategori(this)" style="font-family: 'FontAwesome', Helvetica;" class="form-control" data-show-icon="true">
                <optgroup label="Klasörler">
                    <option value="1" selected>&#xf01c; Bildirimler</option>
                    <option value="2">&#xf187; Arşiv</option>
                    <option value="3">&#xf014; Çöp Kutusu</option>
                </optgroup>   
                <optgroup label="Etiketler">
                    <option value="4" class="text-red">&#xf10c; Yüksek</option>
                    <option value="5" class="text-yellow">&#xf10c; Orta</option>
                    <option value="6" class="text-green">&#xf10c; Düşük</option>
                </optgroup>
                </select>
                
               
   </div>
   
   
   
    <div class="input-group col-md-4 pull-left">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" id="mailadresi" class="form-control" placeholder="Mail adresi"/>
                <span class="input-group-btn">
                      <button type="button" id="kullaniciara" class="btn btn-primary btn-flat"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </span>
   </div>
   
   
   <div class="input-group col-md-4 pull-left">
                <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
                <input type="text" oninput="this.value = this.value.toUpperCase()" id="bildirimid" class="form-control" placeholder="Bildirim no"/>
                <span class="input-group-btn">
                      <button type="button" id="bildirimara" class="btn btn-primary btn-flat"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </span>
   </div>
   
   
  </div>
</div>




<div class="geribildirimler">
@include('panel.geribildirim.geribildirim')
</div>


<div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Bildirim</h4>
              </div>
              <div style="background-color:#ecf0f5;" class="modal-body">
                <div id="modal-icerik"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Kapat</button>
             	<button type="button" onclick="printDiv('modal-icerik')" class="btn btn-default pull-right"><i class="fa fa-print"></i> Yazdır</button>
                
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>


@endsection




@section('js')

<script>
	
	var kategori;
	var sayfa;
	if(kategori == null)
	{
		kategori = "1";
	}

    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {               
            	geribildirimgetPosts(page,kategori);
                }
            }      
    });
    $(document).ready(function() {

    	
        
        $(document).on('click', '#geribildirim-sayfalama .pagination a', function (e) {
        	sayfa = $(this).attr('href').split('page=')[1];
        	geribildirimgetPosts(sayfa,kategori);
            e.preventDefault();           
        });


        $(document).on('click', '#bildirim', function (e) {
        	var id = $(this).data("id")        	
            detay(id);
        });


        $(document).on('click', '#kullaniciara', function (e) {
        	var mail = document.getElementById("mailadresi").value;
            ara(mail);
        });

        $(document).on('click', '#kategorisec', function (e) {
        	var id = document.getElementById("geribildirimid").value;
        	var kategori = document.getElementById("kategoriid").value;        	
        	kategorisec(id,kategori);
        });


        $(document).on('click', '#bildirimara', function (e) {
        	var id = document.getElementById("bildirimid").value;
            bildirimara(id);
        });
        

    });

    $("#mailadresi").keyup(function(event) {
        if (event.keyCode === 13) {
        	var mail = document.getElementById("mailadresi").value;
            ara(mail);
        }
    });

    $("#bildirimid").keyup(function(event) {
        if (event.keyCode === 13) {
        	var id = document.getElementById("bildirimid").value;
            bildirimara(id);
        }
    });

    function geribildirimgetPosts(page,kategori) {
        $.ajax({
            url : '/panel/Geribildirim/kategori/'+kategori+'?page=' + page,
            dataType: 'json',
        }).done(function (data) {
            $('.geribildirimler').html(data);
            location.hash = page;
        }).fail(function () {
        	basarisiz("Başarısız","veri getirilemedi !");
        });
    }


    function bildirimkategori(selectObject) {
    	sayfa = null;
        kategori = selectObject.value;  
        bildirimkategorigetPosts(kategori); 
    }

    function bildirimkategorigetPosts(id) {
        $.ajax({
            url : '/panel/Geribildirim/kategori/' + id,
            dataType: 'json',
        }).done(function (data) {
            $('.geribildirimler').html(data);
            location.hash = page;
        }).fail(function () {
        	basarisiz("Başarısız","veri getirilemedi !");
        });
    }

    function detay(id){
    	$.ajax({
    		   url:'/panel/Geribildirim/detay/'+id,
    		   type:'GET',
    		   success: function(data){    		       
    		       $("#modal-icerik").html(data);  
    		             
    		   }
    		});
   	}


    function ara(mail) {
        $.ajax({
            url : '/panel/Geribildirim/ara/' + mail,
            dataType: 'json',
        }).done(function (data) {
            $('.geribildirimler').html(data);
            location.hash = page;
        }).fail(function () {
			basarisiz("Başarısız","veri getirilemedi !");
        	
        });
    }



    function kategorisec(id,kategori){
   	 $.ajax({
   		   url: '/panel/Geribildirim/kategorisec/'+id+'/'+kategori,
   		   data: {
   		      format: 'json'
   		   },
   		   error: function() {
   			basarisiz("Başarısız","veri getirilemedi !");
   		   },
   		   dataType: 'json',
   		   success: function(data) { 
   			basarili("Başarılı","Taşıma işlemi tamamlandı.");   			
   			yenile();
   		         
   		   },
   		   type: 'GET'
   		});
   	}
   	
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
   }

    function yenile()
    {
    	var mail = document.getElementById("mailadresi").value;
    	var id = document.getElementById("bildirimid").value;

		if(mail != "")
		{
			ara(mail);
		}else if(id != "")
		{
			bildirimara(id);
		}else{
			geribildirimgetPosts(sayfa,kategori);
		}
    	
    	

    }


    function bildirimara(id) {
        $.ajax({
            url : '/panel/Geribildirim/bildirimara/' + id,
            dataType: 'json',
        }).done(function (data) {
            $('.geribildirimler').html(data);
            location.hash = page;
        }).fail(function () {
        	basarisiz("Başarısız","veri getirilemedi !");
        });
    }

	
</script>
@endsection