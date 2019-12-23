<div class="box box-warning">
            <div class="box-header with-border">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info"> 
              
              <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="/panel/Kullanicilar/profil/fotograf/{{ base64_encode($kullanici->mail) }}/128" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h5 class="widget-user-username">{{ $kullanici->mail }}</h5>  
              <h6 class="widget-user-desc">{{ $geribildirim->ip }}</h6>            
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
              <li><a href="#">Bildirim No <span class="pull-right badge"> {{ $geribildirim->kisaid }}</span></a></li>
                <li><a href="#">Cihaz <span class="pull-right badge"> {{ $cihaz->manufacturer }} > {{ $cihaz->model }} > {{ $cihaz->os_version }} </span></a></li>
                <li><a href="#">Uygulama <span class="pull-right badge">{{ $cihaz->app_version }} > {{ $cihaz->app_version_code }}</span></a></li>                             
              </ul>
            </div>
          </div>
             
              </div>
              <!-- /.mailbox-read-info -->
              
              <!--  
              <div class="mailbox-controls with-border text-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
                    <i class="fa fa-trash-o"></i></button>                  
                </div>
                <!-- /.btn-group 
                
               
                
                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                  <i class="fa fa-print"></i></button>
              </div>
              
               -->
              
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
              	
               
               <div class="direct-chat-msg">
                      <div class="direct-chat-info clearfix">                       
                        <span class="direct-chat-timestamp pull-right">{{ $geribildirim->created_at }}</span>
                      </div>
                      <!-- /.direct-chat-info -->
                      <img class="direct-chat-img" src="/panel/Kullanicilar/profil/fotograf/{{ base64_encode($kullanici->mail) }}/75" alt="message user image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        {{ $geribildirim->mesaj }}
                      </div>
                      <!-- /.direct-chat-text -->
               </div>              
               
               
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              
            </div>
            <!-- /.box-footer -->
            <div class="box-footer">
              
               <div class="input-group col-md-5 pull-left">
                <span class="input-group-addon"><i class="fa fa-folder"></i></span>
                
                <input id="geribildirimid" value="{{ encrypt($geribildirim->id) }}" type="hidden"/>
                <select id="kategoriid" style="font-family: 'FontAwesome', Helvetica;" class="form-control" data-show-icon="true">
                <optgroup label="Klasörler">
                    <option value="{{ encrypt(1) }}" @if($geribildirim->kategori == "1") selected @endif>&#xf01c; Bildirimler</option>
                    <option value="{{ encrypt(2) }}" @if($geribildirim->kategori == "2") selected @endif>&#xf187; Arşiv</option>
                    <option value="{{ encrypt(3) }}" @if($geribildirim->kategori == "3") selected @endif>&#xf014; Çöp Kutusu</option>
                </optgroup>   
                <optgroup label="Etiketler">
                    <option value="{{ encrypt(4) }}" @if($geribildirim->kategori == "4") selected @endif class="text-red">&#xf10c; Yüksek</option>
                    <option value="{{ encrypt(5) }}" @if($geribildirim->kategori == "5") selected @endif class="text-yellow">&#xf10c; Orta</option>
                    <option value="{{ encrypt(6) }}" @if($geribildirim->kategori == "6") selected @endif class="text-green">&#xf10c; Düşük</option>
                </optgroup>
                </select>
                <span class="input-group-btn">
                      <button type="button" id="kategorisec" class="btn btn-default btn-flat pull-left"><i class="fa fa-check" aria-hidden="true"></i></button>
                 </span>
               
 		  	</div>
              
            </div>
            <!-- /.box-footer -->
          </div>