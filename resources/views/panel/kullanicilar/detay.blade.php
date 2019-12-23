<section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="/panel/Kullanicilar/profil/fotograf/{{ base64_encode($kullanici->mail) }}/128" alt="">

              <p class="text-muted text-center">{{ $kullanici->mail }}</p>
             

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Cihazlar</b> <a class="pull-right">{{ $cihazsayisi }}</a>
                </li>
                <li class="list-group-item">
                  <b>Girişler</b> <a class="pull-right">{{ $girissayisi }}</a>
                </li> 
                
                <li class="list-group-item">
                  <b>Oturumlar</b> <a class="pull-right">{{ $oturumsayisi }}</a>
                </li> 
                
                <li class="list-group-item">
                  <b>Kayıt</b> <a class="pull-right">{{ $kullanici->created_at }}</a>
                </li>                   
              </ul>

             
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
         
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#cihazlar" data-toggle="tab">Cihazlar</a></li>
              <li><a href="#girisler" data-toggle="tab">Girişler</a></li>
              <li><a href="#oturumlar" data-toggle="tab">Oturumlar</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="cihazlar">
              <div class="cihazlar">
          		 <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>                 
                  <th>Marka</th>
                  <th>Model</th>
                  <th>Android Sürümü</th>
                  <th>Uygulama Sürümü</th>
                  <th></th>                 
                </tr>
                @foreach ($cihazlar as $cihaz)
                <tr>                 
                  <td>{{ $cihaz->manufacturer }}</td>
                  <td>{{ $cihaz->model }}</td>
                  <td>{{ $cihaz->os_version }}</td>
                  <td>{{ $cihaz->app_version }}</td> 
                  <td><button type="button" class="btn btn-primary btn-xs" id="cihaz-modal" data-id="{{encrypt($cihaz->id)}}" data-toggle="modal" data-target="#modal-cihaz">
                <i class="fa fa-eye" aria-hidden="true"></i> Detay
              </button></td>                 
                </tr>   
                @endforeach         
              </table>
              </div>
              <div id="cihazlar-sayfalama">
              {{ $cihazlar->links() }}  
              </div>  
              </div>        
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="girisler">
              <div class="girisler">
                 <div class="box-body table-responsive no-padding">
                 <table class="table table-hover">
                <tr>                 
                  <th>İp Adresi</th>
                  <th>Başlangıç</th>
                  <th>Bitiş</th>
                  <th>Süre</th>                 
                </tr>
                @foreach ($girisler as $giris)
                <tr>                 
                  <td>{{ $giris->ip }}</td>
                  <td>{{ $giris->created_at }}</td>
                  <td>{{ $giris->updated_at }}</td>
                  <td>
                  <?php 
                $dateDiff = intval((strtotime($giris->updated_at)-strtotime($giris->created_at))/60);
				$hours = intval($dateDiff/60);
				$minutes = $dateDiff%60;
				echo "$hours saat $minutes dakika";
				?>
                  </td>                  
                </tr>   
                @endforeach         
              </table>
               </div>
               <div id="girisler-sayfalama">
              {{ $girisler->links() }}
              </div>
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="oturumlar">
             <div class="oturumlar">
              <div class="box-body table-responsive no-padding">
            	<table class="table table-hover">
                <tr>                 
                  <th>Başlangıç Tarihi</th>
                  <th>Bitiş Tarihi</th>
                  <th>Kalan Süre</th>
                  <th></th>                               
                </tr>
                @foreach ($oturumlar as $oturum)
                <tr>                 
                  <td>{{ $oturum->created_at }}</td>
                  <td>{{ gmdate("Y-m-d H:i:s", $oturum->sonkullanimtarihi) }}</td>
                  <td>
                  
                  <?php 
                  
                  $datestr=gmdate("Y-m-d H:i:s", $oturum->sonkullanimtarihi);//Your date
				  $date=strtotime($datestr);//Converted to a PHP date (a second count)


				 $diff=$date-time();//time returns current time in seconds
				$days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
				$hours=round(($diff-$days*60*60*24)/(60*60));

                
				
				
				if($days < 0)
				{
				    echo"Süre Doldu."; 
				}else{
				    echo "$days gün $hours saat kaldı.";
				}
                  
				?>
                  
                  </td>
                  <td><button id="oturumsonlandir" type="button" @if($oturum->sonkullanimtarihi < time()) disabled="disabled" @endif class="btn btn-danger btn-xs" data-id="{{encrypt($oturum->id)}}">
                <i class="fa fa-times" aria-hidden="true"></i> Oturumu Sonlandır
              </button></td>                                   
                </tr>   
                @endforeach         
              </table>
              </div>
              <div id="oturumlar-sayfalama">
              {{ $oturumlar->links() }}   
              </div> 
              </div>                 
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>