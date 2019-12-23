@extends('panel.tema.tema')

@section('baslik','Kullanıcılar')

@section('icerik')

<div class="panel panel-default">
  <div class="panel-body">
   
   
   <div class="input-group col-md-4">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" id="mailadresi" class="form-control" placeholder="Mail adresi"/>
                <span class="input-group-btn">
                      <button type="button" id="kullaniciara" class="btn btn-primary btn-flat"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </span>
   </div>
   
   
  </div>
</div>

<div class="kullanicilar">
@include('panel.kullanicilar.kullanicilar')
</div>

<div class="modal fade" id="modal-default">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><div id="modal-baslik"></div></h4>
              </div>
              <div style="background-color:#ecf0f5;" class="modal-body">
                <div id="modal-icerik"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Kapat</button>
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        


        
        
        
        <div class="modal fade" id="modal-cihaz">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">CİHAZ VE UYGULAMA BİLGİLERİ</h4>
              </div>
              <div style="background-color:#ecf0f5;" class="modal-body">
               <div id="modal-cihaz-icerik"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Kapat</button>                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        
        
        
        
@endsection


@section('js')

<script>
    var sec;
    var id;
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                if(sec == 0)
                {
                	kullanicigetPosts(page);
                }else if(sec == 1)
                {
                	cihazlargetPosts(page,id); 
                }else if(sec == 2)
                {
                	girislergetPosts(page,id); 
                }else if(sec == 3)
                {
                	oturumlargetPosts(page,id);
                }
            }
        }
    });
    $(document).ready(function() {
        $(document).on('click', '#kullanicilar .pagination a', function (e) {
            kullanicigetPosts($(this).attr('href').split('page=')[1]);
            e.preventDefault();
            sec = 0;
        });

        $(document).on('click', '#cihazlar-sayfalama .pagination a', function (e) {        	
            cihazlargetPosts($(this).attr('href').split('page=')[1],id);
            e.preventDefault();
            sec = 1;
        });

        $(document).on('click', '#girisler-sayfalama .pagination a', function (e) {        	
            girislergetPosts($(this).attr('href').split('page=')[1],id);
            e.preventDefault();
            sec = 2;
        });

        $(document).on('click', '#oturumlar-sayfalama .pagination a', function (e) {        	
            girislergetPosts($(this).attr('href').split('page=')[1],id);
            e.preventDefault();
            sec = 3;
        });

        $(document).on('click', '#kullanici-modal', function (e) {
        	id = $(this).data("id")
        	var title = $(this).data("title")
            detay(id,title);
        });


        $(document).on('click', '#cihaz-modal', function (e) {
        	var idx = $(this).data("id")        	
            cihazdetay(idx);
        });

        $(document).on('click', '#kullaniciara', function (e) {
        	var mail = document.getElementById("mailadresi").value;
            ara(mail);
        });


        $(document).on('click', '#oturumsonlandir', function (e) {
        	var id = $(this).data("id")        	
            oturumsonlandir(id);
        });
        
    });
    function kullanicigetPosts(page) {
        $.ajax({
            url : '?page=' + page,
            dataType: 'json',
        }).done(function (data) {
            $('.kullanicilar').html(data);
            location.hash = page;
        }).fail(function () {
            alert('veri getirilemedi !');
        });
    }


    function cihazlargetPosts(page,id) {
        $.ajax({
            url : '/panel/Kullanicilar/detaysayfalama/'+id+'/1?page=' + page,
            dataType: 'json',
        }).done(function (data) {
            $('.cihazlar').html(data);
            location.hash = page;
        }).fail(function () {
            alert('veri getirilemedi !');
        });
    }

    function girislergetPosts(page,id) {
        $.ajax({
            url : '/panel/Kullanicilar/detaysayfalama/'+id+'/2?page=' + page,
            dataType: 'json',
        }).done(function (data) {
            $('.girisler').html(data);
            location.hash = page;
        }).fail(function () {
            alert('veri getirilemedi !');
        });
    }


    function oturumlargetPosts(page,id) {
        $.ajax({
            url : '/panel/Kullanicilar/detaysayfalama/'+id+'/3?page=' + page,
            dataType: 'json',
        }).done(function (data) {
            $('.oturumlar').html(data);
            location.hash = page;
        }).fail(function () {
            alert('veri getirilemedi !');
        });
    }

    $("#mailadresi").keyup(function(event) {
        if (event.keyCode === 13) {
        	var mail = document.getElementById("mailadresi").value;
            ara(mail);
        }
    });


    function ara(mail) {
        $.ajax({
            url : '/panel/Kullanicilar/ara/' + mail,
            dataType: 'json',
        }).done(function (data) {
            $('.kullanicilar').html(data);
            location.hash = page;
        }).fail(function () {
        	basarisiz("Başarısız","veri getirilemedi !");
        });
    }


    function detay(id,title){
    	$.ajax({
    		   url:'/panel/Kullanicilar/detay/'+id,
    		   type:'GET',
    		   success: function(data){    		       
    		       $("#modal-icerik").html(data);
    		       $("#modal-baslik").html(title);
    		   }
    		});
   	}


    function cihazdetay(id){
    	$.ajax({
    		   url:'/panel/Kullanicilar/detay/cihaz/'+id,
    		   type:'GET',
    		   success: function(data){    		       
    		       $("#modal-cihaz-icerik").html(data);    		       
    		   }
    		});
   	}


   	function oturumsonlandir(id)
   	{

   		swal({
   		  title: "İşleme devam edilsin mi ?",
   		  text: "Onay verildiğinde oturum sonlandırılacaktır.",
   		  icon: "warning",   		  
   		  buttons: ["İptal", true],   		  		
   		  dangerMode: true,
   		})
   		.then((willDelete) => {
   		  if (willDelete) {
   		    

   		 $.ajax({
             url : '/panel/Kullanicilar/oturumsonlandir/' + id,
             dataType: 'json',
         }).done(function (data) {

			if(data.oturum == 1)
			{
				basarili("Başarılı","Oturum sonlandırıldı.")
			}else if(data.oturum == 0)
			{
				basarisiz("Başarısız","Oturum daha önce sonlandırılmış !");
			}
             
             
             
         }).fail(function () {
         	basarisiz("Başarısız","veri getirilemedi !");
         });

   		    
   		  } else {
   		    basarisiz("Başarısız","İşlem iptal edildi.")
   		  }
   		});
   		
   	}

    
    </script>


@endsection