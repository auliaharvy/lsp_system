<div class="container">
  <h6>FR.AK.06 MENINJAU LAPORAN ASESMEN</h6>
</div>
<div class="container">
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
      @php
      $ak06 = collect($data[0]);
      @endphp
      <table class="table table-bordered">
        <tr>
          <td class="bg-dark text-white" colspan="3">Penjelasan</td>
        </tr>
        <tr>
          <td>
            <ol type="1">
              <li>Peninjauan seharusnya dilakukan oleh asesor yang mensupervisi implementasi asesmen.</li>
              <li>Jika tinjauan di lakukan oleh asesor lain, tinjauan akan di lakukan setelah seluruh proses
                implementasi asesmen telah
                selesai</li>
              <li>Beri tanda centang pada kolom K jika Anda yakin asesi dapat melakukan/mendemonstrasikan tugas seuai
                KUK, atau centang
                pada kolom BK bila sebaliknya.</li>
              <li>Peninjauan dapat dilakukan secara terpadu dalam skema sertifikasi dan / atau peserta kelompok yang
                homogen.</li>
            </ol>
          </td>
        </tr>
      </table>
      <table class="col-12 table-bordered table">
        <tr>
          <td class="bg-dark text-white text-center px-2" rowspan="2">Aspek Yang Ditinjau</td>
          <td class="bg-dark text-white text-center px-2" colspan="4">Kesesuaian dengan prinsip asesmen</td>
        </tr>
        <tr>
          <td class="bg-dark text-white text-center px-2">Validitas</td>
          <td class="bg-dark text-white text-center px-2">Reliabel</td>
          <td class="bg-dark text-white text-center px-2">Flexibel</td>
          <td class="bg-dark text-white text-center px-2">Adil</td>
        </tr>
        <tr>
          <td class="px-2">Prosedur Asesmen</td>
          <td class="text-center"></td>
          <td class="text-center"></td>
          <td class="text-center"></td>
          <td class="text-center"></td>
        </tr>
        <tr>
          <td class="px-2">Rencana Asesmen</td>
          @if ($ak06['rencana_asesmen_validitas'] == 1)
          <td class="text-center"><input type="checkbox" checked></td>
          @else
          <td class="text-center"><input type="checkbox"></td>
          @endif
          @if ($ak06['rencana_asesmen_reliabel'] == 1)
          <td class="text-center"><input type="checkbox" checked></td>
          @else
          <td class="text-center"><input type="checkbox"></td>
          @endif
          @if ($ak06['rencana_asesmen_fleksibel'] == 1)
          <td class="text-center"><input type="checkbox" checked></td>
          @else
          <td class="text-center"><input type="checkbox"></td>
          @endif
          @if ($ak06['rencana_asesmen_adil'] == 1)
          <td class="text-center"><input type="checkbox" checked></td>
          @else
          <td class="text-center"><input type="checkbox"></td>
          @endif
        </tr>
        <tr>
          <td class="px-2">Persiapan Asesmen</td>
          @if ($ak06['persiapan_asesmen_validitas'] == 1)
          <td class="text-center"><input type="checkbox" checked></td>
          @else
          <td class="text-center"><input type="checkbox"></td>
          @endif
          @if ($ak06['persiapan_asesmen_reliabel'] == 1)
          <td class="text-center"><input type="checkbox" checked></td>
          @else
          <td class="text-center"><input type="checkbox"></td>
          @endif
          @if ($ak06['persiapan_asesmen_fleksibel'] == 1)
          <td class="text-center"><input type="checkbox" checked></td>
          @else
          <td class="text-center"><input type="checkbox"></td>
          @endif
          @if ($ak06['persiapan_asesmen_adil'] == 1)
          <td class="text-center"><input type="checkbox" checked></td>
          @else
          <td class="text-center"><input type="checkbox"></td>
          @endif
        </tr>
        <tr>
          <td class="px-2">Implementasi Asesmen</td>
          @if ($ak06['implementasi_asesmen_validitas'] == 1)
          <td class="text-center"><input type="checkbox" checked></td>
          @else
          <td class="text-center"><input type="checkbox"></td>
          @endif
          @if ($ak06['implementasi_asesmen_reliabel'] == 1)
          <td class="text-center"><input type="checkbox" checked></td>
          @else
          <td class="text-center"><input type="checkbox"></td>
          @endif
          @if ($ak06['implementasi_asesmen_fleksibel'] == 1)
          <td class="text-center"><input type="checkbox" checked></td>
          @else
          <td class="text-center"><input type="checkbox"></td>
          @endif
          @if ($ak06['implementasi_asesmen_adil'] == 1)
          <td class="text-center"><input type="checkbox" checked></td>
          @else
          <td class="text-center"><input type="checkbox"></td>
          @endif
        </tr>
        <tr>
          <td class="px-2">Keputusan Asesmen</td>
          @if ($ak06['keputusan_asesmen_validitas'] == 1)
          <td class="text-center"><input type="checkbox" checked></td>
          @else
          <td class="text-center"><input type="checkbox"></td>
          @endif
          @if ($ak06['keputusan_asesmen_reliabel'] == 1)
          <td class="text-center"><input type="checkbox" checked></td>
          @else
          <td class="text-center"><input type="checkbox"></td>
          @endif
          @if ($ak06['keputusan_asesmen_fleksibel'] == 1)
          <td class="text-center"><input type="checkbox" checked></td>
          @else
          <td class="text-center"><input type="checkbox"></td>
          @endif
          @if ($ak06['keputusan_asesmen_adil'] == 1)
          <td class="text-center"><input type="checkbox" checked></td>
          @else
          <td class="text-center"><input type="checkbox"></td>
          @endif
        </tr>
        <tr>
          <td class="px-2">Umpan Balik Asesmen</td>
          @if ($ak06['umpan_balik_asesmen_validitas'] == 1)
          <td class="text-center"><input type="checkbox" checked></td>
          @else
          <td class="text-center"><input type="checkbox"></td>
          @endif
          @if ($ak06['umpan_balik_asesmen_reliabel'] == 1)
          <td class="text-center"><input type="checkbox" checked></td>
          @else
          <td class="text-center"><input type="checkbox"></td>
          @endif
          @if ($ak06['umpan_balik_asesmen_fleksibel'] == 1)
          <td class="text-center"><input type="checkbox" checked></td>
          @else
          <td class="text-center"><input type="checkbox"></td>
          @endif
          @if ($ak06['umpan_balik_asesmen_adil'] == 1)
          <td class="text-center"><input type="checkbox" checked></td>
          @else
          <td class="text-center"><input type="checkbox"></td>
          @endif
        </tr>
      </table>
      <table class="col-12 table-bordered">
        <tr>
          <td colspan="2">
            <br>
          </td>
        </tr>
        <tr>
          <td class="col-3">Rekomendasi Untuk Peningkatan</td>
          <td class="col-9">{{ $ak06['rekomendasi_prosedur'] }}</td>
        </tr>
      </table>
      <table class="table table-bordered mt-3" style="table-layout:fixed">
        <tr>
          <td class="bg-dark text-white text-center px-2" rowspan="2">Aspek Yang Ditinjau</td>
          <td class="bg-dark text-white text-center px-2" colspan="5">Kesesuaian dengan prinsip asesmen</td>
        </tr>
        <tr>
          <td class="bg-dark text-white text-center px-2">Task Skills</td>
          <td class="bg-dark text-white text-center px-2">Task Management Skills</td>
          <td class="bg-dark text-white text-center px-2">Contigency Management Skills</td>
          <td class="bg-dark text-white text-center px-2">Job Role / Environment Skills</td>
          <td class="bg-dark text-white text-center px-2">Transfer Skills</td>
        </tr>
        <tr>
          <td>Konsistensi keputusan asesmen Bukti dari berbagai asesmen
            diperiksa untuk konsistensi dimensi kompetensi</td>
          <td>{{ $ak06['task_skill'] }}</td>
          <td>{{ $ak06['task_management_skill'] }}</td>
          <td>{{ $ak06['contigency_management_skill'] }}</td>
          <td>{{ $ak06['job_role'] }}</td>
          <td>{{ $ak06['transfer_skill'] }}</td>
        </tr>
      </table>
      <table class="col-12 table-bordered">
        <tr>
          <td colspan="2">
            <br>
          </td>
        </tr>
        <tr>
          <td class="col-3">Rekomendasi Untuk Peningkatan</td>
          <td class="col-9">{{ $ak06['rekomendasi_konsistensi'] }}</td>
        </tr>
      </table>
      <table class="table table-bordered mt-3">
        <tr>
          <td class="text-center">Nama Asesor</td>
          <td class="text-center">Tanggal</td>
          <td class="text-center">Tanda Tangan Asesor</td>
          <td class="text-center">Komentar</td>
        </tr>
        <tr>
          <td class="text-center">{{ $asesor }}</td>
          <td class="text-center">{{ $skemaSertifikasi['mulai']}}</td>
          <td class="text-center">
            <img class="img-fluid" src="{{ public_path('/uploads/users/signature/'.$ak06['tanda_tangan_asesor'])}}"
              alt="">
          </td>
          <td class="text-center">{{ $ak06['komentar']}}</td>
        </tr>
      </table>
    </div>
  </div>
</div>