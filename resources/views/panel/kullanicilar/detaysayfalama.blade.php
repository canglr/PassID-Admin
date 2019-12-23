@if($tip == 1)


 <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>                 
                  <th>Marka</th>
                  <th>Model</th>
                  <th>Android Sürümü</th>
                  <th>Uygulama Sürümü</th>                 
                </tr>
                @foreach ($cihazlar as $cihaz)
                <tr>                 
                  <td>{{ $cihaz->manufacturer }}</td>
                  <td>{{ $cihaz->model }}</td>
                  <td>{{ $cihaz->os_version }}</td>
                  <td>{{ $cihaz->app_version }}</td>                  
                </tr>   
                @endforeach         
              </table>
              </div>
              <div id="cihazlar-sayfalama">
              {{ $cihazlar->links() }}  
              </div>    

@elseif($tip == 2)


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
              
@elseif($tip == 3)

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
@else


@endif