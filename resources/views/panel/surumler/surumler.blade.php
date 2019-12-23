<button type="button" data-target="#modal-yenisurum" data-toggle="modal" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Yeni Sürüm</button>
<div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>                 
                  <th>Sürüm Kodu</th>
                  <th>Sürüm Durumu</th>
                  <th>Son Güncellenme Tarihi</th>
                  <th></th>
                </tr>
                @foreach ($surumler as $surum)
                <tr>                 
                  <td>{{ $surum->SurumKodu }}</td>
                  <td>@if($surum->SurumDurumu == true) Açık  @else Kapalı @endif</td>
                  <td>{{ $surum->updated_at }}</td>
                  <td>
                  <button type="button" class="btn btn-primary btn-xs btn-flat" id="surumguncelle-modal" onclick="surumgetir(this)" data-id="{{ encrypt($surum->id) }}" data-toggle="modal" data-target="#modal-surumguncelle">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Düzenle
              </button>
                  </td>
                </tr>   
                @endforeach         
              </table>
              <div id="surumler">
              {{ $surumler->links() }}
              </div>
</div>