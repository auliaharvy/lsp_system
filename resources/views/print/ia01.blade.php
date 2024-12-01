
@php $counter = 1; @endphp
<div class="pr-4 mt-10">
	<h6>FR.IA.01. CEKLIS OBSERVASI AKTIVITAS DI TEMPAT KERJA ATAU TEMPAT KERJA SIMULASI</h6>
</div>
<div class="pr-4">
	<div class="row">
		<div class="col-12">
			<div class="table-responsive">
				<table class="table table-bordered tree">
					<tr>
						<td class="bg-dark" colspan="5"></td>
					</tr>
					<tr>
						<td rowspan="2">
							<div>Skema Sertifikasi (KKNI/Okupasi/Klaster)</div>
						</td>
						<td>
							<div>Judul</div>
						</td>
						<td>
							<div>:</div>
						</td>
						<td colspan="2">
							<div>{{ $skemaSertifikasi->skema_sertifikasi }}</div>
						</td>
					</tr>
					<tr>
						<td>
							<div>Nomor</div>
						</td>
						<td>
							<div>:<div>
						</td>
						<td colspan="2">
							<div>{{ $skemaSertifikasi->kode_skema }}</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div>TUK</div>
						</td>
						<td>
							<div>:</div>
						</td>
						<td colspan="2">
							<div>{{ $skemaSertifikasi->nama_tuk }}</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div>Nama Asesor</div>
						</td>
						<td>
							<div>:</div>
						</td>
						<td colspan="2">
							<div>{{ $skemaSertifikasi->nama_asesor }}</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div>Nama Asesi</div>
						</td>
						<td>
							<div>:</div>
						</td>
						<td colspan="2">
							<div>{{ $skemaSertifikasi->nama_lengkap }}</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div>Tanggal</div>
						</td>
						<td>
							<div>:</div>
						</td>
						<td colspan="2">
							<div>{{ $skemaSertifikasi->mulai }}</div>
						</td>
					</tr>
				</table>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered tree">
					<tr>
						<td class="bg-dark text-white text-center">
							<div><strong>PANDUAN BAGI ASESOR</strong></div>
						</td>
					</tr>
					<tr>
						<td>
						<ul>
							<li>Lengkapi nama unit kompetensi, elemen, dan kriteria unjuk kerja sesuai kolom dalam tabel.</li>
							<li>Isi lah standar industri atau tempat kerja.</li>
							<li>Beri tanda centang ceklis pada kolom "Ya" jika Anda yakin asesai dapat melakukan/
								mendemonstrasikan tugas sesuai KUK, atau centang x pada kolom "Tidak" bila sebaliknya.</li>
							<li>Penilaian lanjutan diisi bila hasil belum dapat disimpulkan, untuk itu gunakan metode lain
								sehingga keputusan dapat dibuat.</li>
							<li>Isi lah kolom KUK sesuai dengan Unit Kompetensi/SKKNI.</li>
						</ul>
						</td>
					</tr>
				</table>
			</div>
			<div style="page-break-after: always"></div>
			<div class="table-responsive">
					<table class="table table-bordered tree">
							<tr>
									<td class="bg-dark text-white text-center align-middle" rowspan="{{ $kelompok_pekerjaan->count() + 1 }}">Kelompok Pekerjaan {{ $nama_kelompok_pekerjaan }}</td>
									<td class="bg-dark text-white text-center">No</td>
									<td class="bg-dark text-white text-center">Kode Unit</td>
									<td class="bg-dark text-white text-center">Judul Unit</td>
							</tr>
							@foreach($kelompok_pekerjaan as $row)
									<tr>
											<td>{{ $loop->iteration }}</td>
											<td>{{ $row->kode_unit }}</td>
											<td>{{ $row->unit_kompetensi }}</td>
									</tr>
							@endforeach
					</table>
			</div>

			@foreach($data['listDataKuk'] as $row)
				<div class="table-responsive">
					<table class="table table-bordered tree">
						<tr>
							<td rowspan="2" colspan="6">Unit Kompetensi {{ $loop->iteration }}</td>
							<td>Kode Unit</td>
							<td>:</td>
							<td colspan="2">{{ $row['kode_unit']}}</td>
						</tr>
						<tr>
							<td>Judul Unit</td>
							<td>:</td>
							<td colspan="2">{{ $row['unit_kompetensi']}}</td>
						</tr>
					</table>
				</div>
				<div class="table-responsive">
					<table class="table table-bordered tree" style="margin-bottom: 50px; border-collapse: collapse;">
						<tr>
							<td class="bg-dark text-white text-center align-middle" rowspan="2">No.</td>
							<td class="bg-dark text-white text-center align-middle" rowspan="2">Elemen</td>
							<td class="bg-dark text-white text-center align-middle" rowspan="2">Kriteria Untuk Kerja</td>
							<td class="bg-dark text-white text-center align-middle" rowspan="2">Standard Industri atau Tempat kerja</td>
							<td class="bg-dark text-white text-center align-middle" colspan="2">Pencapaian</td>
							<td class="bg-dark text-white text-center align-middle" rowspan="2">Penilaian Lanjut</td>
						</tr>
						<tr>
							<td class="bg-dark text-white text-center">K</td>
							<td class="bg-dark text-white text-center">BK</td>
						</tr>
						<tbody>
							@foreach($row['elemen'] as $item)
									@foreach($item['kuk'] as $listkuk)
											<tr>
													<td class="text-center align-middle">{{ $loop->first ? $counter : '' }}</td>
													<td class="align-middle">{{ $loop->first ? $item['nama_elemen'] : '' }}</td>
													<td>{{ $listkuk['kuk'] }}</td>
													<td>{{ $item['benchmark'] }}</td>
													<td>
															@if($listkuk['is_kompeten_from_ia_01_detail']->is_kompeten == 1)
																	<input type="checkbox" checked aria-label="Checkbox for following text input">
															@endif
													</td>
													<td>
															@if($listkuk['is_kompeten_from_ia_01_detail']->is_kompeten == 0)
																	<input type="checkbox" checked aria-label="Checkbox for following text input">
															@endif
													</td>
													<td>
															{{ $listkuk['penilaian_lanjut_from_ia_01_detail']->penilaian_lanjut }}
													</td>
											</tr>
									@endforeach
									
									@if($loop->last) 
											@php $counter = 1; @endphp
									@else
											@php $counter++; @endphp
									@endif
							@endforeach
					</tbody>

					</table>
				</div>
			@endforeach
		</div>
	</div>
</div>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    thead {
        display: table-header-group;
    }
    tbody {
        display: table-row-group;
    }
    tr {
        page-break-inside: avoid;
    }
		.styled-list {
		padding-left: 20px; /* Memberikan ruang di kiri */
		list-style-type: disc; /* Menggunakan tanda bulat */
	}
	.styled-list div {
		display: list-item; /* Membuat elemen <div> tampil seperti <li> */
		list-style-position: inside; /* Menampilkan tanda bulat di dalam padding */
	}
</style>