<div class="box-body table-responsive no-padding">
<table style="background-color:white;" class="table table-hover">

<tr>
<th>Paket Adı:</th>
<td>{{ $cihaz->package_name }}</td>
</tr>
<tr>
<th>Uygulama Adı:</th>
<td>{{ $cihaz->app_name }}</td>
</tr>
<tr>
<th>Uygulama Versiyonu:</th>
<td>{{ $cihaz->app_version }}</td>
</tr>
<tr>
<th>Uygulama Versiyon Kodu:</th>
<td>{{ $cihaz->app_version_code }}</td>
</tr>
<tr>
<th>Marka:</th>
<td>{{ $cihaz->manufacturer }}</td>
</tr>
<tr>
<th>Model:</th>
<td>{{ $cihaz->model }}</td>
</tr>
<tr>
<th>İşletim Sistemi Sürümü:</th>
<td>{{ $cihaz->os_version }}</td>
</tr>
<tr>
<th>Ürün:</th>
<td>{{ $cihaz->product }}</td>
</tr>
<tr>
<th>Aygıt:</th>
<td>{{ $cihaz->device }}</td>
</tr>
<tr>
<th>Anakart:</th>
<td>{{ $cihaz->board }}</td>
</tr>
<tr>
<th>Donanım:</th>
<td>{{ $cihaz->hardware }}</td>
</tr>
<tr>
<th>Kök İzni:</th>
<td>@if($cihaz->is_device_rooted == "false") yok @else var @endif </td>
</tr>
<tr>
<th>Operatör Ülke Kodu:</th>
<td>{{ $cihaz->sim_country }}</td>
</tr>
<tr>
<th>Operatör Adı:</th>
<td>{{ $cihaz->sim_carrier }}</td>
</tr>
<tr>
<th>Nfc Desteği:</th>
<td>@if($cihaz->is_nfc_present == "false") yok @else var @endif</td>
</tr>
<tr>
<th>Nfc Durumu:</th>
<td>@if($cihaz->is_nfc_enabled == "false") kapalı @else açık @endif</td>
</tr>
<tr>
<th>Ekran Çözünürlüğü:</th>
<td>{{ $cihaz->display_resolution }}</td>
</tr>
<tr>
<th>Kayıt Tarihi:</th>
<td>{{ $cihaz->created_at }}</td>
</tr>
<tr>
<th>Son Güncellenme Tarihi:</th>
<td>{{ $cihaz->updated_at }}</td>
</tr>

</table>
</div>
