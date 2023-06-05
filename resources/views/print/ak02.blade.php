<div class="container">
  <h6>FR.AK.02 FORMULIR REKAMAN ASESMEN KOMPETENSI</h6>
</div>
<div class="container">
  <div class="row">
    <table class="table">
      <tr>
        <td class="bg-dark" colspan="3"></td>
      </tr>
      <tr>
        <td class="justify-content-center">Nama Asesi</td>
        <td class="justify-content-center">:</td>
        <td class="justify-content-center">{{ $skemaSertifikasi['nama_peserta'] }}</td>
      </tr>
      <tr>
        <td class="justify-content-center">Nama Asesor</td>
        <td class="justify-content-center">:</td>
        <td class="justify-content-center">{{ $asesor }}</td>
      </tr>
      <tr>
        <td class="justify-content-center">Skema Sertifikasi</td>
        <td class="justify-content-center">:</td>
        <td class="justify-content-center">{{ $skemaSertifikasi['skema_sertifikasi']}}</td>
      </tr>
      <tr>
        <td class="justify-content-center">Tanggal Mulai Asesmen</td>
        <td class="justify-content-center">:</td>
        <td class="justify-content-center">{{ $skemaSertifikasi['mulai']}}</td>
      </tr>
      <tr>
        <td class="justify-content-center">Tanggal Selesai Asesmen</td>
        <td class="justify-content-center">:</td>
        <td class="justify-content-center">{{ $skemaSertifikasi['selesai']}}</td>
      </tr>
    </table>
    <table class="col-12 table table-bordered table-striped" style="table-layout: fixed">
      <tr>
        <td class="bg-dark text-white text-center text-wrap px-2">Unit Kompetensi</td>
        <td class="bg-dark text-white text-center text-wrap px-2">Observasi Demonstrasi</td>
        <td class="bg-dark text-white text-center text-wrap px-2">Portofolio</td>
        <td class="bg-dark text-white text-center text-wrap px-2">Pernyataan Pihak Ketiga Pertanyaan Wawancara</td>
        <td class="bg-dark text-white text-center text-wrap px-2">Pernyataan Lisan</td>
        <td class="bg-dark text-white text-center text-wrap px-2">Pernyataan Tertulis</td>
        <td class="bg-dark text-white text-center text-wrap px-2">Proyek Kerja</td>
        <td class="bg-dark text-white text-center text-wrap px-2">Lainnya</td>
      </tr>
      @php
      $detailAk02 = collect($data['detail'])
      @endphp
      @foreach ($detailAk02 as $key => $item)
      <tr>
        <td class="justify-content-center px-2">{{ $detailAk02[$key]['pertanyaan']}}</td>
        @if ($detailAk02[$key]['observasi_demonstrasi'] == 1)
        <td class="text-center"><input type="checkbox" checked></td>
        @else
        <td class="text-center"><input type="checkbox"></td>
        @endif
        @if ($detailAk02[$key]['portofolio'] == 1)
        <td class="text-center"><input type="checkbox" checked></td>
        @else
        <td class="text-center"><input type="checkbox"></td>
        @endif
        @if ($detailAk02[$key]['pernyataan_pihak_3'] == 1)
        <td class="text-center"><input type="checkbox" checked></td>
        @else
        <td class="text-center"><input type="checkbox"></td>
        @endif
        @if ($detailAk02[$key]['pernyataan_lisan'] == 1)
        <td class="text-center"><input type="checkbox" checked></td>
        @else
        <td class="text-center"><input type="checkbox"></td>
        @endif
        @if ($detailAk02[$key]['pernyataan_tertulis'] == 1)
        <td class="text-center"><input type="checkbox" checked></td>
        @else
        <td class="text-center"><input type="checkbox"></td>
        @endif
        @if ($detailAk02[$key]['proyek_kerja'] == 1)
        <td class="text-center"><input type="checkbox" checked></td>
        @else
        <td class="text-center"><input type="checkbox"></td>
        @endif
        @if ($detailAk02[$key]['lainnya'] == 1)
        <td class="text-center"><input type="checkbox" checked></td>
        @else
        <td class="text-center"><input type="checkbox"></td>
        @endif
      </tr>
      @endforeach
    </table>
  </div>
  <div class="col-auto mt-3">
    Rekomendasi Asesor :
    @if ($data['ak_02']['rekomendasi_asesor'] == 'Kompeten')
    <div class="formradio d-inline p-3">
      <input type="radio" checked id=radiokompeten>
      <label for="radiokompeten">Kompeten</label>
    </div>
    <div class="formradio d-inline p-3">
      <input type="radio" id=radiobelumkompetevn>
      <label for="radiobelumkompeten">Belum Kompeten</label>
    </div>
    @else
    <div class="formradio d-inline p-3">
      <input type="radio" id=radiokompeten>
      <label for="radiokompeten">Kompeten</label>
    </div>
    <div class="formradio d-inline p-3">
      <input type="radio" checked id=radiobelumkompetevn>
      <label for="radiobelumkompeten">Belum Kompeten</label>
    </div>
    @endif
  </div>
  <div class="col-auto mt-3">
    <label for="textareakompeten" class="align-top d-inline">Tindak Lanjut Yang dibutuhkan : </label>
    <textarea id=textareakompeten class="form-control" cols="80"
      rows="5">{{ $data['ak_02']['tindak_lanjut']}}</textarea>
  </div>
  <div class="col-auto mt-3">
    <label for="textareakompeten" class="align-top d-inline">Komentar Observasi Oleh Asesor : </label>
    <textarea id=textareakompeten class="form-control" cols="80" rows="5">{{ $data['ak_02']['komentar']}}</textarea>
  </div>
</div>