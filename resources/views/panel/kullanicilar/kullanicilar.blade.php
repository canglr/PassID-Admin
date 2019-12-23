<div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>                 
                  <th>Mail</th>
                  <th>Kayıt Tarihi</th>
                  <th>Son Güncellenme Tarihi</th>
                  <th></th>
                </tr>
                @foreach ($kullanicilar as $kullanici)
                <tr>                 
                  <td>{{ $kullanici->mail }}</td>
                  <td>{{ $kullanici->created_at }}</td>
                  <td>{{ $kullanici->updated_at }}</td>
                  <td><button type="button" class="btn btn-primary btn-xs" id="kullanici-modal" data-id="{{encrypt($kullanici->id)}}" data-title="{{$kullanici->mail}}" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-eye" aria-hidden="true"></i> Detay
              </button></td>
                </tr>   
                @endforeach         
              </table>
              <div id="kullanicilar">
              {{ $kullanicilar->links() }}
              </div>
            </div>