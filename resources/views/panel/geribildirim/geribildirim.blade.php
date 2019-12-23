<div class="row">
        <div class="col-md-3">
         

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Klasörler</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#"><i class="fa fa-inbox"></i> Bildirimler
                  <span class="label label-primary pull-right">{{ $sayilar[1] }} / {{ $sayilar[0] }}</span></a></li>                
                <li><a href="#"><i class="fa fa-archive"></i> Arşiv <span class="label label-warning pull-right">{{ $sayilar[2] }}</span></a>
                </li>
                <li><a href="#"><i class="fa fa-trash-o"></i> Çöp Kutusu <span class="label label-danger pull-right">{{ $sayilar[3] }}</span></a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Etiketler</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#"><i class="fa fa-circle-o text-red"></i> Yüksek <span class="label label-danger pull-right">{{ $sayilar[4] }}</span></a></li>
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Orta <span class="label label-warning pull-right">{{ $sayilar[5] }}</span></a></li>
                <li><a href="#"><i class="fa fa-circle-o text-green"></i> Düşük <span class="label label-success pull-right">{{ $sayilar[6] }}</span></a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Bildirimler</h3>

              
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>                 
                </div>
                <!-- /.btn-group -->
                <button type="button" onclick="yenile()" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  @foreach($geribildirimler as $geribildirim)
                  <tr id="bildirim" data-id="{{encrypt($geribildirim->id)}}">
                    <td><input type="checkbox"></td>    
                    <td class="mailbox-date">{{ $geribildirim->kisaid }}</td>                
                    <td class="mailbox-subject">@if($geribildirim->okundu == false) <b>  @if(strlen($geribildirim->mesaj) > 30 ) {{ substr($geribildirim->mesaj, 0, 30)."..." }} @else {{ $geribildirim->mesaj  }} @endif  </b>  @else @if(strlen($geribildirim->mesaj) > 30 ) {{ substr($geribildirim->mesaj, 0, 30)."..." }} @else {{ $geribildirim->mesaj  }} @endif  @endif        </td>
                   
                    <td class="mailbox-date">{{ $geribildirim->created_at }}</td>
                     <td class="mailbox-attachment"><button type="button" class="btn btn-primary btn-xs" id="geribildirim-modal" data-id="{{encrypt($geribildirim->id)}}" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-eye" aria-hidden="true"></i> Oku
              </button></td>
                  </tr> 
                  @endforeach                 
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>                 
                </div>
                <!-- /.btn-group -->
                <button type="button" onclick="yenile()" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                <div id="geribildirim-sayfalama">
                  {{ $geribildirimler->links() }}
                  <!-- /.btn-group -->
                  </div>
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
