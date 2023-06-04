<div class="container">
  <h6>FR.AK.03 UMPAN BALIK DAN CATATAN ASESMEN</h6>
</div>
<div class="container">
  <div class="row">
    <div class="col-12">
      <table class="table">
        <tr>
          <td class="bg-dark" colspan="3"></td>
        </tr>
        <tr>
          <td>Nama Asesi</td>
          <td>:</td>
          <td>{{ $skemaSertifikasi['nama_peserta']}}</td>
        </tr>
        <tr>
          <td>Nama Asesor</td>
          <td>:</td>
          <td>{{ $asesor }}</td>
        </tr>
        <tr>
          <td>Skema Sertifikasi</td>
          <td>:</td>
          <td>{{ $skemaSertifikasi['skema_sertifikasi']}}</td>
        </tr>
        <tr>
          <td>Tanggal</td>
          <td>:</td>
          <td>{{ $skemaSertifikasi['mulai'] }}</td>
        </tr>
      </table>
      <table class="col-md-12 table-bordered table-striped">
        <tr>
          <td class="bg-dark text-white text-center px-2">Komponen</td>
          <td class="bg-dark text-white text-center px-2">Hasil</td>
          <td class="bg-dark text-white text-center px-2">Catatan / Komentar Asesi</td>
        </tr>
        @php
        $detailAk03 = collect($data['detail'])
        @endphp
        @foreach ($detailAk03 as $key => $item)
        <tr>
          <td class="justify-content-center px-2">{{ $detailAk03[$key]['komponen'] }}</td>
          @if ($detailAk03[$key]['hasil'] == '1')
          <td class="justify-content-center text-center px-2">Ya</td>
          @else
          <td class="justify-content-center text-center px-2">Tidak</td>
          @endif
          <td class="justify-content-center text-center px-2"> {{ $detailAk03[$key]['catatan'] }}</td>
        </tr>
        @endforeach
      </table>
    </div>
    <div class="col-12 mt-3">
      <label for="textareakompeten" class="align-top d-inline">Catatan / Komentar lainya (Apabila ada) : </label>
      <textarea id=textareakompeten class="form-control" cols="80" rows="5">{{ $data['ak_03']['komentar']}}</textarea>
    </div>
  </div>
</div>
</div>
</div>