<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<p style=""><strong>FR.APL.01. PERMOHONAN SERTIFIKASI KOMPETENSI</strong></div>
	&nbsp;</div>
	<p style=""><strong>Bagian 1 :&nbsp; Rincian Data Pemohon Sertifikasi</strong></div>
	<div style=" font-weight: 400; padding: 0 0 10px 0;">Pada bagian ini,&nbsp; cantumlan data pribadi, data pendidikan formal serta data pekerjaan anda pada saat ini.</div>
	<p style=""><strong>a. Data Pribadi</strong></div>
	<table >
		<tr  >
			<td style="padding-left: 15px;">
				<div style=" font-weight: 400; padding: 0 0 10px 0;">Nama lengkap</div>
			</td>
			<td>
				<div style=" font-weight: 400; padding: 0 10px 10px 0;">:</div>
			</td>
			<td>
				<div style=" font-weight: 400; padding: 0 0 10px 0;">@php echo $apl01->nama_lengkap@endphp</div>
			</td>
		</tr>
		<tr  >
			<td style="padding-left: 15px;">
				<div style=" font-weight: 400; padding: 0 0 10px 0;">No. KTP/NIK/Paspor</div>
			</td>
			<td>
				<div style=" font-weight: 400; padding: 0 10px 10px 0;">:</div>
			</td>
			<td>
				<div style=" font-weight: 400; padding: 0 0 10px 0;">@php echo $apl01->nik@endphp</div>
			</td>
		</tr>
		<tr  >
			<td style="padding-left: 15px;">
				<div style=" font-weight: 400; padding: 0 0 10px 0;">Tempat / tgl. Lahir</div>
			</td>
			<td>
				<div style=" font-weight: 400; padding: 0 10px 10px 0;">:</div>
			</td>
			<td>
				<div style=" font-weight: 400; padding: 0 0 10px 0;">@php echo $apl01->tempat_lahir@endphp / @php echo $apl01->tanggal_lahir@endphp</div>
			</td>
		</tr>
		<tr  >
			<td style="padding-left: 15px;">
				<div style=" font-weight: 400; padding: 0 0 10px 0;">Jenis kelamin</div>
			</td>
			<td>
				<div style=" font-weight: 400; padding: 0 10px 10px 0;">:</div>
			</td>
			<td>
				<div style=" font-weight: 400; padding: 0 0 10px 0;">@php echo $apl01->jenis_kelamin@endphp</div>
			</td>
		</tr>
		<tr  >
			<td style="padding-left: 15px;">
				<div style=" font-weight: 400; padding: 0 0 10px 0;">Alamat rumah</div>
			</td>
			<td>
				<div style=" font-weight: 400; padding: 0 10px 10px 0;">:</div>
			</td>
			<td>
				<div style=" font-weight: 400; padding: 0 0 10px 0;">@php echo $apl01->alamat@endphp</div>
			</td>
		</tr>
		<tr  >
			<td style="padding-left: 15px;">
				<div style=" font-weight: 400; padding: 0 0 10px 0;">No HP</div>
			</td>
			<td>
				<div style=" font-weight: 400; padding: 0 10px 10px 0;">:</div>
			</td>
				<div style=" font-weight: 400; padding: 0 0 10px 0;">@php echo $apl01->no_hp@endphp</div> 
			</td>
		</tr>
		<tr  >
			<td style="padding-left: 15px;">
				<div style=" font-weight: 400; padding: 0 0 10px 0;">Email</div>
			</td>
			<td>
				<div style=" font-weight: 400; padding: 0 10px 10px 0;">:</div>
			</td>
				<div style=" font-weight: 400; padding: 0 0 10px 0;">@php echo $apl01->email@endphp</div>
			</td>
		</tr>
		<tr  >
			<td style="padding-left: 15px;">
				<div style=" font-weight: 400; padding: 0 0 10px 0;">Kualifikasi Pendidikan</div>
			</td>
			<td>
				<div style=" font-weight: 400; padding: 0 10px 10px 0;">:</div>
			</td>
			<td>
				<div style=" font-weight: 400; padding: 0 0 10px 0;">@php echo $apl01->nama_sekolah@endphp (@php echo $apl01->tingkatan@endphp)</div>
			</td>
		</tr>
		</tbody>
	</table>
	<p style=""><strong>b. Data Pekerjaan Sekarang</strong></div>
	<table >
		<tbody>
			<tr  >
				<td style="padding-left: 15px;">
					<div style=" font-weight: 400; padding: 0 0 10px 0;">Nama Institusi / Perusahaan</div>
				</td>
				<td>
					<div style=" font-weight: 400; padding: 0 10px 10px 0;">:</div>
				</td>
			</tr>
			<tr  >
				<td style="padding-left: 15px;">
					<div style=" font-weight: 400; padding: 0 0 10px 0;">Jabatan</div>
				</td>
				<td>
					<div style=" font-weight: 400; padding: 0 10px 10px 0;">:</div>
				</td>
			</tr>
			<tr  >
				<td style="padding-left: 15px;">
					<div style=" font-weight: 400; padding: 0 0 10px 0;">Alamat</div>
				</td>
				<td>
					<div style=" font-weight: 400; padding: 0 10px 10px 0;">:</div>
				</td>
			</tr>
			<tr  >
				<td style="padding-left: 15px;">
					<div style=" font-weight: 400; padding: 0 0 10px 0;">No Telp</div>
				</td>
				<td>
					<div style=" font-weight: 400; padding: 0 10px 10px 0;">:</div>
				</td>
			</tr>
			<tr  >
				<td style="padding-left: 15px;">
					<div style=" font-weight: 400; padding: 0 0 10px 0;">Email</div>
				</td>
				<td>
					<div style=" font-weight: 400; padding: 0 10px 10px 0;">:</div>
				</td>
			</tr>
			<tr  >
				<td style="padding-left: 15px;">
					<div style=" font-weight: 400; padding: 0 0 10px 0;">Fax</div>
				</td>
				<td>
					<div style=" font-weight: 400; padding: 0 10px 10px 0;">:</div>
				</td>
			</tr>
		</tbody>
	</table>
	<div style="font-weight: 400">Bagian&nbsp; 2 :&nbsp; Data Sertifikasi</strong></div>
	<div style="font-weight: 400; padding-bottom: 20px;">Tuliskan Judul dan Nomor Skema Sertifikasi yang anda ajukan berikut Daftar Unit Kompetensi sesuai kemasan pada skema sertifikasi untuk mendapatkan pengakuan sesuai dengan latar belakang pendidikan, pelatihan serta pengalaman kerja yang anda miliki.</div></div>
	<table style="border: 1px solid black;">
		<tbody>
			<tr>
				<td style="border: 1px solid black;">
					<div style="text-align: center;">Skema Sertifikasi &nbsp; (KKNI/Okupasi/Klaster)</div>
				</td>
				<td style="border: 1px solid black;">
					<table>
						<tr>
							<td>
								<span style="text-align: center;">Judul</span>
							</td>
							<td>
								<span style=" font-weight: 400; padding: 0 10px 10px 0;">:</span>
							</td>
							<td style="width: 100%;">
								<span style="text-align: center;">@php echo $skema->skema_sertifikasi@endphp</span>
							</td>
						</tr>
						<tr>
							<td>
								<span style="text-align: center;">Nomor</span>
							</td>
							<td>
								<span style=" font-weight: 400; padding: 0 10px 10px 0;">:</span>
							</td>
							<td>
								<span style="text-align: center;">@php echo $skema->kode_skema@endphp</span>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<span style="text-align: center;">Tujuan Asesmen</span>
				</td>
				<td style="border: 1px solid black;">
					<table>
						<tr>
							<td style="padding-left: 52px;">
								<span style="padding-left: 30px; font-weight: 400; padding: 0 10px 10px 0;">:</span>
							</td>
							<td>
								<span style=" font-weight: 400; padding: 0 10px 10px 0;">1. </span>
							</td>
							<td>
								<span style="text-align: center;">Sertifikasi</span>
							</td>
						</tr>
						<tr>
							<td>
								<span style="padding-left: 30px; font-weight: 400; padding: 0 10px 10px 0;"></span>
							</td>
							<td>
								<span style=" font-weight: 400; padding: 0 10px 10px 0;">2. </span>
							</td>
							<td>
								<span style="text-align: center;">Sertifikasi Ulang</span>
							</td>
						</tr>
						<tr>
							<td>
								<span style="padding-left: 30px; font-weight: 400; padding: 0 10px 10px 0;"></span>
							</td>
							<td>
								<span style=" font-weight: 400; padding: 0 10px 10px 0;">3. </span>
							</td>
							<td>
								<span style="text-align: center;">Pengakuan Kompetensi Terkini (PKT)</span>
							</td>
						</tr>
						<tr>
							<td>
								<span style="padding-left: 30px; font-weight: 400; padding: 0 10px 10px 0;"></span>
							</td>
							<td>
								<span style=" font-weight: 400; padding: 0 10px 10px 0;">4. </span>
							</td>
							<td>
								<span style="text-align: center;">Rekognisi Pembelajaran Lampau</span>
							</td>
						</tr>
						<tr>
							<td>
								<span style="padding-left: 30px; font-weight: 400; padding: 0 10px 10px 0;"></span>
							</td>
							<td>
								<span style=" font-weight: 400; padding: 0 10px 10px 0;">5. </span>
							</td>
							<td>
								<span style="text-align: center;">Lainnya</span>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	<div style="font-weight: 400">Daftar Unit Kompetensi sesuai kemasan:&nbsp;</strong></div>
	<table style="width: 100%;">
		<tbody style="width: 100%;">
			<tr style="width: 100%;">
				<td style="width: 5%;">
					<div style="font-weight: 400; text-align: center;">No.</strong></div>
				</td>
				<td style="width: 25%;">
					<div style="font-weight: 400; text-align: center;">Kode Unit</strong></div>
				</td>
				<td style="width: 45%;">
					<div style="font-weight: 400; text-align: center;">Judul Unit</strong></div>
				</td>
				<td style="width: 25%;">
					<div style="font-weight: 400; text-align: center;">Jenis Standar (Standar Khusus/Standar Internasional/SKKNI)</strong></div>
				</td>
			</tr>
			@php $no = 0; @endphp
			@php $index = 0; @endphp
			@foreach($unit_kompetensi as $unit)
			@php $no++; @endphp
			<tr style="width: 100%;">
				<td style="width: 5%;">
					<div style="font-weight: 400; text-align: center;">{{ $no }}</div>
				</td>
				<td style="width: 25%;">
					<div style="font-weight: 400; text-align: center;">{{ $unit->kode_unit }}</div>
				</td>
				<td style="width: 45%;">
					<div>{{ $unit->unit_kompetensi}}</div>
				</td>
				<td style="width: 25%;">
					<div style="font-weight: 400; text-align: center;">SKKNI</strong></div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<p><strong>Bagian&nbsp; 3&nbsp; :&nbsp; Bukti Kelengkapan Pemohon&nbsp;&nbsp;</strong></p>
	<p><strong>Bukti Persyaratan Dasar Pemohon</strong></p>
	<table style="width: 100%;">
		<tbody style="width: 100%;">
			<tr style="width: 100%;">
				<td style="width: 5%;" rowspan="2">
					<div style="font-weight: 400; text-align: center;"><strong>No.</strong></div>
				</td>
				<td style="width: 65%;" rowspan="2">
					<div style="text-align: center;"><strong>Bukti Persyaratan Dasar</strong></div>
				</td>
				<td style="width: 15%;" colspan="2">
					<div style="text-align: center;"><strong>Ada</strong></div>
				</td>
				<td style="width: 15%;" rowspan="2">
					<div style="text-align: center;"><strong>Tidak Ada&nbsp;</strong></div>
				</td>
			</tr>
			<tr>
				<td>
					<div style="text-align: center;"><strong>Memenuhi Syarat&nbsp;</strong></div>
				</td>
				<td>
					<div style="text-align: center;"><strong>Tidak Memenuhi Syarat&nbsp;</strong></div>
				</td>
			</tr>
			<tr>
				<td style="width: 5%;">
					<div style="text-align: center;">1.</div>
				</td>
				<td style="width: 55%;">
					<div>Pas Foto 3x4</div>
				</td>
				<td style="width: 10%;">
					@if($apl01->foto !== '')
						<div style="text-align: center;"></div>
					@endif
				</td>
				<td style="width: 10%; text-align: center;">
					@if($apl01->foto === '')
						<div style="text-align: center;"><i class="bi bi-x-lg"></i></div>
					@endif
				</td>
				<td style="width: 20%; text-align: center;">
					<div style="text-align: center;"></div>
				</td>
			</tr>
			<tr>
				<td style="width: 5%;">
					<div style="text-align: center;">2.</div>
				</td>
				<td style="width: 55%;">
					<div>Fotocopy Sertifikat PKL</div>
				</td>
				<td style="width: 10%; text-align: center;">
					@if($apl01->sertifikat !== '')
						<div style="text-align: center;"><i class="bi bi-check2"></i></div>
					@endif
				</td>
				<td style="width: 10%; text-align: center;">
					@if($apl01->sertifikat === '')
						<div style="text-align: center;"><i class="bi bi-x-lg"></i></div>
					@endif
				</td>
				<td style="width: 20%; text-align: center;">
					<div style="text-align: center;"></div>
				</td>
			</tr>
			<tr>
				<td style="width: 5%;">
					<div style="text-align: center;">3.</div>
				</td>
				<td style="width: 55%;">
					<div>Fotocopy KK/KTP/Kartu Pelajar</div>
				</td>
				<td style="width: 10%; text-align: center;">
					@if($apl01->identitas !== '')
						<div style="text-align: center;"><i class="bi bi-check2"></i></div>
					@endif
				</td>
				<td style="width: 10%; text-align: center;">
					@if($apl01->identitas === '')
						<div style="text-align: center;"><i class="bi bi-x-lg"></i></div>
					@endif
				</td>
				<td style="width: 20%; text-align: center;">
					<div style="text-align: center;"></div>
				</td>
			</tr>
			<tr>
				<td style="width: 5%;">
					<div style="text-align: center;">4.</div>
				</td>
				<td style="width: 55%;">
					<div>Fotocopy Raport sem. 1-4</div>
				</td>
				<td style="width: 10%; text-align: center;">
					@if($apl01->raport !== '')
						<div style="text-align: center;"><i class="bi bi-check2" /></div>
					@endif
				</td>
				<td style="width: 10%; text-align: center;">
					@if($apl01->raport === '')
						<div style="text-align: center;"><i class="bi bi-x-lg" /></div>
					@endif
				</td>
				<td style="width: 20%; text-align: center;">
					<div style="text-align: center;"></div>
				</td>
			</tr>
		</tbody>
	</table>
	<table style="width: 100%;">
		<tbody style="width: 100%;">
			<tr style="width: 100%;">
				<td style="width: 50%;" rowspan="3">
					<div><strong>Rekomendasi (diisi oleh LSP):</strong></div>
					<div style="font-weight: 400;">Berdasarkan ketentuan persyaratan dasar, maka pemohon:&nbsp;</span></div>
					<div><strong>Diterima/ </strong><strong>Tidak diterima</strong><span style="font-weight: 400;"> *) sebagai peserta&nbsp; sertifikasi</span></div>
					<div style="font-weight: 400;">* coret yang tidak sesuai</div>
				</td>
				<td style="width: 50%;" colspan="2">
					<div><strong>Pemohon/ Kandidat :</strong></div>
				</td>
			</tr>
			<tr>
				<td style="width: 50%;">
					<div style="font-weight: 400;">Nama&nbsp;</div>
				</td>
			</tr>
			<tr>
				<td style="width: 50%; height: 100px;">
					<div style="font-weight: 400;">Tanda tangan/</div>
					<div style="font-weight: 400;">Tanggal</div>
				</td>
			</tr>
			<tr>
				<td style="width: 50%;" rowspan="4">
					<div><strong>Catatan :</strong></div>
				</td>
				<td style="width: 50%;" colspan="2">
					<div><strong>Admin LSP &nbsp; :</strong></div>
				</td>
			</tr>
			<tr>
				<td style="width: 50%;">
					<div style="font-weight: 400;">Nama&nbsp;</div>
				</td>
			</tr>
			<tr>
				<td style="width: 50%;">
					<div style="font-weight: 400;">No. Reg</div>
				</td>
			</tr>
			<tr>
				<td style="width: 50%; height: 100px;">
					<div style="font-weight: 400;">Tanda tangan/</div>
					<div style="font-weight: 400;">Tanggal</div>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>