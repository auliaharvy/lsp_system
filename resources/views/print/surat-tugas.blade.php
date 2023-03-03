<!DOCTYPE html>
<html>
<head>
	<title>@php echo $jadwal->jadwal @endphp</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
        table th {
            text-align: center !important;
        },
        li {
            padding: 0 !important;
            margin: 0 !important;
        },
        body {
            font-family: "Arial" !important;
            padding-top: 0;
            padding-bottom: 0;
        }
        .no-padding {
            padding-top: 0;
            padding-bottom: 0;
        }
        .page-break {
            page-break-after: always !important;
        }
        .kop {
            width: 100%;
            height: 100px;
        }
        .divAdios {
            float: right;
        }
	</style>
	<center>
        <img src="<?php echo storage_path('app/kop-surat.jpg'); ?>"  style="width: 100%; height" />
	</center>
    <center>
        <h3>SURAT TUGAS</h3>
        <h5 class="no-padding">No : @php echo $jadwal->id @endphp/III/2023</h5>
	</center>
	<table class='table table-borderless table-sm'>
		<tbody>
			<tr class="no-padding">
				<td class="no-padding">Menimbang</td>
				<td class="no-padding"> : </td>
				<td class="no-padding">bahwa dalam rangka melaksanakan Uji Sertifikasi bagi siswa di LSP SMKN 2 Cikarang Barat, perlu dibuatkan surat perintah tugas yang ditetapkan oleh Ketua LSP.</td>
			</tr>
            <tr class="no-padding">
				<td class="no-padding">Dasar</td>
				<td class="no-padding"> : </td>
				<td class="no-padding">Pedoman BNSP No. 201 Tahun 2014 dan PBNSP lainnya.</td>
			</tr>
		</tbody>
	</table>
    <center>
        DIPERINTAHKAN
	</center>
    Kepada nama dibawah ini :
    <table class='table table-bordered table-sm'>
        <thead>
			<tr class="no-padding">
				<th>No</th>
				<th>Nama</th>
				<th>No Registrasi</th>
			</tr>
		</thead>
		<tbody>
			<tr class="no-padding">
				<td class="no-padding" style="text-align: center">1</td>
				<td class="no-padding">@php echo $jadwal->nama_asesor @endphp</td>
				<td class="no-padding">@php echo $jadwal->no_reg @endphp</td>
			</tr>
		</tbody>
	</table>
    <ol class="no-padding">
        <li class="no-padding">    
            Untuk melaksanakan tugas sebagai asesor, Pada :
            <table class='table table-borderless table-sm' style="padding: 0; margin: 0">
                <tbody style="padding: 0; margin: 0">
                    <tr class="no-padding">
                        <td style="width: 17%">Tanggal</td>
                        <td>@php echo date('d-m-Y', strtotime($jadwal->start_date)); @endphp</td>
                    </tr>
                    <tr class="no-padding">
                        <td style="width: 17%">Waktu</td>
                        <td>08:00 - selesai</td>
                    </tr>
                    <tr class="no-padding">
                        <td style="width: 17%">Skema</td>
                        <td>@php echo $jadwal->nama_skema @endphp</td>
                    </tr>
                    <tr class="no-padding">
                        <td style="width: 17%">TUK</td>
                        <td>@php echo $jadwal->nama_tuk @endphp</td>
                    </tr>
                    <tr class="no-padding">
                        <td style="width: 17%">Jumlah Peserta</td>
                        <td>@php echo count($uji) @endphp</td>
                    </tr>
                </tbody>
            </table>
        </li>
        <li class="no-padding">    
            Untuk melakukan pengembangan materi uji kompetensi sesuai dengan skema yang di ujikan. Setelah melaksanakan tugas segera membuat laporan tertulis kepada ketua LSP / Kepala Bidang
        </li>
        <li class="no-padding">
            Sertifikasi paling lambat 2 ( dua hari kalender ) setelah pelaksanaan dimaksud.
        </li>
        <li class="no-padding">    
            Melaksanakan perintah tugas ini dengan sebaik-baiknya dan dengan penuh tanggung jawab sesuai PBNSP yang berlaku.
        </li>
        <li class="no-padding">
            Biaya yang timbul akibat dikeluarkan surat perintah tugas ini sepenuhnya menjadi tanggung jawab LSP SMKN 2 Cikarang Barat.
        </li>
    </ol>
    Demikian surat tugas ini kami buat untuk dapat digunakan sebagaimana mestinya.
    <div class="divAdios">
        Bekasi, {{ date('d-m-Y') }} <br>
        Ketua LSP <br />
        <!-- Space for signature. -->
        <br />
        <br />
        <br />
        Ade Hermawan Zulkarnain, M.Kom
    </div>

    <div class="page-break"></div>

    <center>
        <img src="<?php echo storage_path('app/kop-surat.jpg'); ?>"  style="width: 100%; height" />
	</center>
    <table class='table table-borderless table-sm'>
        <tbody>
            <tr>
                <td>Nama</td>
                <td>@php echo $jadwal->nama_asesor; @endphp</td>
            </tr>
            <tr>
                <td>Profesi</td>
                <td>Asesor Kompetensi</td>
            </tr>
            <tr>
                <td>No Registrasi</td>
                <td>@php echo $jadwal->no_reg @endphp</td>
            </tr>
            <tr>
                <td>Total Peserta</td>
                <td>@php echo count($uji) @endphp</td>
            </tr>
        </tbody>
    </table>
    <table class='table table-bordered table-sm'>
        <thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Skema Sertifikasi</th>
			</tr>
		</thead>
		<tbody>
            @php $i=1 @endphp
			@foreach($uji as $row)
			<tr>
				<td style="text-align: center; width: 10%">{{ $i++ }}</td>
				<td style="width: 15%">{{$row->nama_lengkap}}</td>
				<td>{{$jadwal->nama_skema}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
    <div class="divAdios">
        Bekasi, {{ date('d-m-Y') }} <br>
        Ketua LSP <br />
        <!-- Space for signature. -->
        <br />
        <br />
        <br />
        Ade Hermawan Zulkarnain, M.Kom
    </div>
</body>
</html>