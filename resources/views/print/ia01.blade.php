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
			<table class="table table-bordered">
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
			<table class="table table-bordered" style="margin-top: 50px;">
				<tr>
					<td class="bg-dark" colspan="7"></td>
				</tr>
				@php $a = 1; @endphp
				@foreach($skemaUnit as $unit)
				<tr>
					<td rowspan="2">
						<div>Unit Kompetensi {{ $a }}</div>
					</td>
					<td>
						<div>Kode Unit</div>
					</td>
					<td>
						<div>:</div>
					</td>
					<td colspan="2">
						<div>{{ $unit->kode_unit }}</div>
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
						<div>{{ $unit->unit_kompetensi }}</div>
					</td>
				</tr>
				@php $a++; @endphp
				@endforeach
			</table>
			<table class="table table-bordered">
				@php 
					$indexUnitKompetensi = 1; 
				@endphp
				@foreach($data as $row)
					<tr>
						<td>
							<div><strong>Unit Kompetensi: {{ $indexUnitKompetensi }}</strong></div>
						</td>
						<td colspan="4">
							<div>{{ $row['unit_kompetensi'] }}</div>
						</td>
					</tr>
					<tr>
						<td class="bg-dark text-white text-center" colspan="2">
							<div><strong>Dapatkah Saya ................?</strong></div>
						</td>
						<td class="bg-dark text-white text-center">
							<div><strong>K</strong></div>
						</td>
						<td class="bg-dark text-white text-center">
							<div><strong>BK</strong></div>
						</td>
						<td class="bg-dark text-white text-center">
							<div><strong>Benchmark (SOP / spesifikasi produk industri)</strong></div>
						</td>
						<td class="bg-dark text-white text-center">
							<div><strong>Penilaian Lanjut</strong></div>
						</td>
					</tr>
					@foreach($row['elemen'] as $item)
						<tr>
							<td colspan="2">
								<ol>
									<li>Elemen: {{ $item['nama_elemen'] }}</li>
								</ol>
								<ul>
									<li>Kriteria Unjuk Kerja:</li>
								</ul>
									<ol>
										@foreach($item['kuk'] as $atom)
											<li>{{ $atom['kuk'] }}</li>
										@endforeach
									</ol>
								</ul>
							</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					@endforeach
				@php $indexUnitKompetensi++; @endphp
				@endforeach
			</table>
		</div>
	</div>
</div>