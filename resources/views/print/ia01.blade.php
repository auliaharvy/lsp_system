<div class="pr-4 mt-10">
	<h6>FR.IA.01. CEKLIS OBSERVASI AKTIVITAS DI TEMPAT KERJA ATAU TEMPAT KERJA SIMULASI</h6>
</div>
<div class="pr-4">
	<div class="row">
		<div class="col-12">
			<table class="table table-bordered">
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
			<table class="table table-bordered" style="margin-bottom: 300px;">
				<tr>
					<td class="bg-dark text-white text-center">
						<div><strong>PANDUAN ASESMEN MANDIRI</strong></div>
					</td>
				</tr>
				<tr>
					<td>
						<div><strong>Instruksi:</strong></div>
						<ul>
							<li>Baca setiap pertanyaan di kolom sebelah kiri.</li>
							<li>Beri tanda centang <input type="checkbox" checked aria-label="Checkbox for following text input"> pada kotak jika Anda yakin dapat melakukan tugas yang
								dijelaskan.</li>
							<li>Isi kolom di sebelah kanan dengan mendaftar bukti yang Anda miliki untuk menunjukkan
								bahwa Anda melakukan tugas-tugas ini.</li>
						</ul>
					</td>
				</tr>
			</table>
			@php $noUnitKompetensi = 1; $noKuk = 1; $noElemen = 1; @endphp
			@foreach($data['listDataKuk'] as $row)
				<table class="table table-bordered">
					<tr>
						<td class="bg-dark" colspan="6">
							<div></div>
						</td>
					</tr>
					<tr>
						<td rowspan="2" colspan="6">
							<div>Unit Kompetensi {{ $noUnitKompetensi }}</div>
						</td>
						<td>
							<div>Kode Unit</div>
						</td>
						<td>
							<div>:</div>
						</td>
						<td colspan="2">
							<div>{{ $row['kode_unit']}}</div>
						</td>
					</tr>
					<tr>
						<td>
							<div>Judul Unit</div>
						</td>
						<td>
							<div>:</div>
						</td>
						<td colspan="2">
							<div>{{ $row['unit_kompetensi']}}</div>
						</td>
					</tr>
				</table>
				@foreach($row['elemen'] as $item)
				<table class="table table-bordered" style="margin-bottom: 50px;">
					<tr>
						<td class="bg-dark text-white text-center" rowspan="2">
							<div><strong>Elemen {{ $noElemen }} : {{ $item['nama_elemen'] }}</strong></div>
						</td>
					</tr>
					<tr>
						<td class="bg-dark text-white text-center" rowspan="2">
							<div><strong>No.</strong></div>
						</td>
						<td class="bg-dark text-white text-center" rowspan="2">
							<div><strong>Kriteria Untuk Kerja*</strong></div>
						</td>
						<td class="bg-dark text-white text-center" rowspan="2">
							<div><strong>Benchmark (SOP / spesifikasi produk industri)</strong></div>
						</td>
						<td class="bg-dark text-white text-center" colspan="2">
							<div><strong>Rekomendasi</strong></div>
						</td>
						<td class="bg-dark text-white text-center" rowspan="2">
							<div><strong>Penilaian Lanjut</strong></div>
						</td>
					</tr>
					<tr>
						<td class="bg-dark text-white text-center">
							<div><strong>K</strong></div>
						</td>
						<td class="bg-dark text-white text-center">
							<div><strong>BK</strong></div>
						</td>
					</tr>
					@foreach($item['kuk'] as $listkuk)
					<tr>
						<td>{{ $noKuk }}</td>
						<td>{{ $listkuk['kuk'] }}</td>
						<td>{{ $item['benchmark'] }}</td>
						<td>
							@if($listkuk['is_kompeten_from_ia_01_detail']['is_kompeten'] == 1)
								<input type="checkbox" checked aria-label="Checkbox for following text input">
							@endif
						</td>
						<td>
							@if($listkuk['is_kompeten_from_ia_01_detail']['is_kompeten'] == 0)
								<input type="checkbox" checked aria-label="Checkbox for following text input">
							@endif
						</td>
						<td>{{ $listkuk['penilaian_lanjut_from_ia_01_detail']['penilaian_lanjut'] }}</td>
					</tr>
					@php $noKuk++; @endphp
					@endforeach
					@php $noKuk = 1; @endphp
				</table>
				@php $noElemen++; @endphp
				@endforeach
				@php $noUnitKompetensi++; @endphp
			@endforeach
		</div>
	</div>
</div>