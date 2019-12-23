@extends('panel.tema.tema')

@section('baslik','Ana Sayfa')

@section('icerik')

<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3 id="kullanicisayisi">0</h3>

              <p>Kullanıcı</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-plus"></i>
            </div>
            <a href="#" class="small-box-footer">Daha Fazla <i class="fa fa-arrow-circle-right"></i></a>
          </div>
</div>

<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3 id="cihazsayisi">0</h3>

              <p>Cihaz</p>
            </div>
            <div class="icon">
              <i class="fa fa-mobile"></i>
            </div>
            <a href="#" class="small-box-footer">Daha Fazla <i class="fa fa-arrow-circle-right"></i></a>
          </div>
</div>


<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3 id="cevrimicikullanicisayisi">0</h3>

              <p>Çevrimiçi kullanıcı</p>
            </div>
            <div class="icon">
              <i class="fa fa-globe"></i>
            </div>
            <a href="#" class="small-box-footer">Daha Fazla <i class="fa fa-arrow-circle-right"></i></a>
          </div>
</div>


<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3 id="cevrimicicihazsayisi">0</h3>

              <p>Çevrimiçi cihaz</p>
            </div>
            <div class="icon">
              <i class="fa fa-globe"></i>
            </div>
            <a href="#" class="small-box-footer">Daha Fazla <i class="fa fa-arrow-circle-right"></i></a>
          </div>
</div>

@endsection




@section('js')


<script>
jQuery(document).ready(function(){   
             
        	toplam();

        	cevrimici();

        	setInterval(function(){toplam()}, 10000);
        	setInterval(function(){cevrimici()}, 10000);
               
            });




function toplam(){
	 $.ajax({
		   url: '/panel/api/toplam',
		   data: {
		      format: 'json'
		   },
		   error: function() {
		      $('#kullanicisayisi').html('-1');
		      $('#cihazsayisi').html('-1');
		   },
		   dataType: 'json',
		   success: function(data) { 
			  $('#kullanicisayisi').empty() 
			  $('#cihazsayisi').empty()      		      
		      $('#kullanicisayisi').append(data.kullanicisayisi)
		      $('#cihazsayisi').append(data.cihazsayisi)
		         
		   },
		   type: 'GET'
		});
	}


function cevrimici(){
	 $.ajax({
		   url: '/panel/api/cevrimici',
		   data: {
		      format: 'json'
		   },
		   error: function() {
		      $('#cevrimicicihazsayisi').html('-1');	
		      $('#cevrimicikullanicisayisi').html('-1');	     
		   },
		   dataType: 'json',
		   success: function(data) { 
			  $('#cevrimicicihazsayisi').empty()	
			  $('#cevrimicikullanicisayisi').empty()		  		      
		      $('#cevrimicicihazsayisi').append(data.cevrimicicihazsayisi)
		      $('#cevrimicikullanicisayisi').append(data.cevrimicikullanicisayisi)		      
		         
		   },
		   type: 'GET'
		});
	}

		

         
      </script>

@endsection