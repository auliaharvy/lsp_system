<div class="container">
  <h6>FR.IA.07 PERTANYAAN LISAN</h6>
</div>
<div class="row">
  <div class="col-12">
    <table class="table">
      <tr>
        <td class="bg-dark" colspan="3"></td>
      </tr>
      <tr>
        <td>Skema Sertifikasi</td>
        <td>:</td>
        <td>{{ $skemaSertifikasi->skema_sertifikasi }}</td>
      </tr>
      <tr>
        <td>TUK</td>
        <td>:</td>
        <td>{{ $skemaSertifikasi->nama_tuk }}</td>
      </tr>
      <tr>
        <td>Nama Asesor</td>
        <td>:</td>
        <td>{{ $asesor }}</td>
      </tr>
      <tr>
        <td>Nama Asesi</td>
        <td>:</td>
        <td>{{ $skemaSertifikasi->nama_peserta}}</td>
      </tr>
      <tr>
        <td>Tanggal</td>
        <td>:</td>
        <td>{{ $skemaSertifikasi->mulai }}</td>
      </tr>
    </table>
    <table class="col-md-12 table-bordered table-striped">
      <tr>
        <td class="bg-dark text-white text-center px-2">No.</td>
        <td class="bg-dark text-white text-center px-2">Unit Kompetensi</td>
        <td class="bg-dark text-white text-center px-2">Pertanyaan</td>
        <td class="bg-dark text-white text-center px-2">Jawaban</td>
      </tr>
      @php
      $detailIa07 = collect( $data['detail'] );
      @endphp
      @foreach ($detailIa07 as $key => $item)
      <tr>
        <td class="text-center px-2">{{ $key+1 }}</td>
        <td class="justify-content-center px-2">{{ $detailIa07[$key]['kode_unit'] }} <br>
          {{ $detailIa07[$key]['unit_kompetensi'] }}</td>
        <td class="justify-content-center px-2">{{ $detailIa07[$key]['pertanyaan'] }}</td>
        <td class="justify-content-center px-2">{{ $detailIa07[$key]['jawaban'] }}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div>