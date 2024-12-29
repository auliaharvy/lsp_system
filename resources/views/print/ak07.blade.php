<div class="px-4">
  <h6>FR.AK.07 CEKLIS PENYESUAIAN YANG WAJAR dan BERALASAN</h6>
</div>
<div class="px-4">
  <div class="row">
    <div class="col-12">
      <table class="table">
        <tr>
          <td class="bg-dark" colspan="3"></td>
        </tr>
        <tr>
          <td>Skema Sertifikasi</td>
          <td>:</td>
          <td>{{ $skemaSertifikasi['skema_sertifikasi']}}</td>
        </tr>
        <tr>
          <td>TUK</td>
          <td>:</td>
          <td>{{ $skemaSertifikasi['nama_tuk'] }}</td>
        </tr>
        <tr>
          <td>Nama Asesor</td>
          <td>:</td>
          <td>{{ $asesor }}</td>
        </tr>
        <tr>
          <td>Nama Asesi</td>
          <td>:</td>
          <td>{{ $skemaSertifikasi['nama_peserta']}}</td>
        </tr>
        <tr>
          <td>Tanggal</td>
          <td>:</td>
          <td>{{ $skemaSertifikasi['mulai']}}</td>
        </tr>
      </table>
      <table class="table table-bordered">
        <tr>
          <td class="bg-dark text-white" colspan="3">Panduan Bagi Asesor</td>
        </tr>
        <tr class="no-page-break">
          <td>
            <ul>
              <li>Formulir ini di isi oleh asesor kompetensi dapat sebelum, pada saat atau setelah melakukan
                asesmen dengan methode observasi demonstrasi
              </li>
              <li>Pertanyaan dibuat dengan tujuan untuk menggali, dapat berisi pertanyaan yang berkaitan
                dengan dimensi kompetensi, batasan variabel dan aspek kritis yang relevan dengan skenario
                tugas dan praktik demonstrasi
              </li>
              <li>Jika pertanyaan disampaikan sebelum asesi melakukan praktik demonstrasi, maka
                pertanyaan dibuat berkaitan dengan aspek K3L, SOP, penggunaan peralatasn dan
                perlengkapan.
              </li>
              <li>Jika setelah asesi melakukan praktik demonstrasi terdapat item pertanyaan pendukung
                observasi telah terpenuhi, maka pertanyaan tersebut tidak perlu ditanyakan lagi dan cukup
                memberi catatan bahwa sudah terpenuhi pada saat tugas praktek demonstrasi pada kolom
                tanggapan
              </li>
              <li>Jika pada saat observasi adalah hal yang perlu dikonfirmasi sedangkan di instrumen daftar
                pertanyaan pendukung observasi tidak ada, maka asesor dapat memberikan pertanyaan
                dengan syarat pertanyaan harus berkaitan dengan tugas praktek demonstrasi. jika dilakukan,
                asesor harus mencatat dalam instrumen pertanyaan pendukung observasi.
              </li>
              <li>Tanggapan asesi ditulis pada kolom tanggapan
              </li>
            </ul>
          </td>
        </tr>
      </table>
			<div style="page-break-after: always"></div>
      <div class="table-responsive">
        <table class="table table-bordered tree">
          @foreach($data['potensi_asesi']['data'] as $row)
            <tr>
              @if($loop->first)
                <td rowspan="{{ $data['potensi_asesi']['data']->count() + 1 }}" valign="middle" style="text-align: center; vertical-align: middle;">Potensi Asesi</td>
              @endif
              <td>
                @if($row['potensi'] == 1)
                  <input type="checkbox" checked aria-label="Checkbox for following text input">
                @endif
                @if($row['potensi'] == 0)
                  <input type="checkbox" aria-label="Checkbox for following text input">
                @endif
              </td>
              <td>{{ $row['komponen']}}</td>
            </tr>
          @endforeach
        </table>
      </div>
      <div style="page-break-after: always"></div>
			<div class="table-responsive">
					<table class="table table-bordered tree">
          <tr>
            <td class="bg-dark text-white text-center" style="width: 5%;" rowspan="2">No</td>
            <td class="bg-dark text-white text-center text-center align-middle" style="width: 40%;" rowspan="2">Mengidentifikasi Persyaratan Modifikasi dan Kontekstualisasi (karakteristik asesi)</td>
            <td class="bg-dark text-white text-center" style="width: 20%;" colspan="2">Diperlukan penyesuaian **</td>
            <td class="bg-dark text-white text-center text-center align-middle" style="width: 35%;" rowspan="2" colspan="2">Keterangan</td>
          </tr>
          <tr>
            <td class="bg-dark text-white text-center" style="width: 10%;">Ya</td>
            <td class="bg-dark text-white text-center" style="width: 10%;">Tidak</td>
            <td class="bg-dark text-white text-center" style="width: 5%;" colspan="2"> </td>
          </tr>
          @php
            $counter = 1;
            $tempid = 0;
          @endphp
          @foreach($data['persyaratan']['data'] as $item)
            <tr>
                <td class="text-center align-middle" style="width: 10%;">{{ $tempid == $item['id'] ? '' : $counter++ }}</td>
                <td class="align-middle" style="width: 10%;">{{ $tempid == $item['id'] ? '' : $item['parent_component'] }}</td>
                <td></td>
                <td></td>
                <td style="width: 5%;">
                  @if($item['keterangan'] == 1)<input type="checkbox" checked aria-label="Checkbox for following text input">
                  @elseif($item['keterangan'] == 0)<input type="checkbox" aria-label="Checkbox for following text input">@endif
                </td>
                <td style="width: 30%;">{{ $item['child_component'] }}</td>
            </tr>
            @php  if($tempid != $item['id']){ $tempid = $item['id'];} @endphp
            @endforeach
					</table>
			</div>
      <div style="page-break-after: always"></div>
      <div class="table-responsive">
        <table class="table table-bordered tree">
          <tr>
            <td class="bg-dark text-white text-center" colspan="2">Hasil Penyesuaian yang wajar dan beralasan disepakati menggunakan: </ style="width: 70%;"td>		
          </tr>
          <tr>
            <td style="width: 30%;">Acuan Pembanding</td>		
            <td style="width: 70%;">{{ $data['ak07']['data'][0]['acuan_pembanding'] }}</td>		
          </tr>
          <tr>
            <td style="width: 30%;">Metode Asesmen</td>		
            <td style="width: 70%;">{{ $data['ak07']['data'][0]['metode_asesmen'] }}</td>		
          </tr>
          <tr>
            <td style="width: 30%;">Instrumen Asesmen</td>		
            <td style="width: 70%;">{{ $data['ak07']['data'][0]['instrumen_asesmen'] }}</td>		
          </tr>
        </table>
      </div>
      <div style="page-break-after: always"></div>
      <div class="table-responsive">
        <table class="table table-bordered tree">
          <tr>
            <td colspan="3">
              <div>Nama Asesor : </div>
              <div>{{ $asesor }}</div>
            </td>
            <td colspan="2">
              <div>Tanggal dan Tanda Tangan Asesor : </div>
              @if($data['ak07']['data'][0]['ttd_asesor'] !== '')
                <div>
                  <div>{{ $data['tanggal'] }}</div>
                  <img class="img-fluid" src="{{ public_path('/uploads/users/signature/'. $data['ak07']['data'][0]['ttd_asesor'] )}}" alt="">
                </div>
              @else
                <div><strong>Belum bertanda tangan</strong></div>
              @endif
            </td>					
          </tr>
          <tr>
            <td colspan="3">
              <div>Nama Asesi : </div>
              <div>{{ $skemaSertifikasi['nama_peserta']}}</div>
            </td>
            <td colspan="2">
              <div>Tanggal dan Tanda Tangan Asesi : </div>
              @if($data['ak07']['data'][0]['ttd_asesi'] !== '')
                <div>
                  <div>{{ $data['tanggal'] }}</div>
                  <img class="img-fluid" src="{{ public_path('/uploads/users/signature/'. $data['ak07']['data'][0]['ttd_asesi'] )}}" alt="">
                </div>
              @else
                <div><strong>Belum bertanda tangan</strong></div>
              @endif
            </td>					
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>