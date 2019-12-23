
           
                <ul class="menu">
                
                @foreach($mesajlar as $mesaj)
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="/panel/Kullanicilar/profil/fotograf/{{ base64_encode($mesaj->kullanici_id) }}/160" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        {{ $mesaj->kisaid }}
                        <small><i class="fa fa-clock-o"></i> {{ $mesaj->created_at }}</small>
                      </h4>
                      <p>@if($mesaj->okundu == false)<b>  @if(strlen($mesaj->mesaj) > 36 ) {{ substr($mesaj->mesaj, 0, 36)."..." }} @else {{ $mesaj->mesaj  }} @endif  </b>  @else @if(strlen($mesaj->mesaj) > 36 ) {{ substr($mesaj->mesaj, 0, 36)."..." }} @else {{ $mesaj->mesaj  }} @endif  @endif </p>
                    </a>
                  </li>
                  @endforeach    
                  
                  <!-- end message -->
                </ul>
             