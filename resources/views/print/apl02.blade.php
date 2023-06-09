<div class="pr-4 mt-10">
	<h6>FR.APL.02. ASESMEN MANDIRI</h6>
</div>
<div class="pr-4">
	<div class="row">
		<div class="col-12">
			<table class="table table-bordered">
				<tr>
					<td class="bg-dark" colspan="4"></td>
				</tr>
				<tr>
					<td rowspan="2">
						<div>Skema Sertifikasi &nbsp; (KKNI/Okupasi/Klaster)</div>
					</td>
					<td>
						<div>Judul</div>
					</td>
					<td>
						<div>:</div>
					</td>
					<td>
						<div>{{ $skemaSertifikasi->skema_sertifikasi }}</div>
					</td>
				</tr>
				<tr>
					<td>
						<div>Nomor</div> </td>
					<td>
						<div>:</div>
					</td>
					<td>
						<div>{{ $skemaSertifikasi->kode_skema }}</div>
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
							<li>Beri tanda centang <input type="checkbox" checked aria-label="Checkbox for following text input"> pada kotak jika Anda yakin dapat melakukan tugas yang dijelaskan.</li>
							<li>Isi kolom di sebelah kanan dengan mendaftar bukti yang Anda miliki untuk menunjukkan bahwa Anda melakukan tugas-tugas ini.</li>
						</ul>
					</td>
				</tr>
			</table>
			<table class="table table-bordered">
				@php 
					$indexUnitKompetensi = 1; 
					$indexElemen = 1; 
				@endphp
				@foreach($data['listDataKuk'] as $row)
					<tr>
						<td class="bg-dark text-white" >
							<div><strong>Unit Kompetensi: {{ $indexUnitKompetensi }}</strong></div>
						</td>
						<td class="bg-dark text-white" colspan="4">
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
							<div><strong>Bukti yang relevan</strong></div>
						</td>
					</tr>
					@foreach($row['elemen'] as $item)
						<tr>
							<td colspan="2">
								<div>{{ $indexElemen }}.   Elemen: {{ $item['nama_elemen'] }}</div>
								<ul>
									<li>Kriteria Unjuk Kerja:</li>
								</ul>
								<ol>
									@foreach($item['kuk'] as $listkuk)
										<li>{{ $listkuk['kuk'] }}</li>
									@endforeach
								</ol>
							</td>
							<td class="pl-4">
								@php
									$kompeten = 0;
									$belumKompeten = 0;
								@endphp
								@foreach($item['kuk'] as $iskompeten)
									@if($iskompeten['is_kompeten_from_apl_02_detail']->is_kompeten == 0)
										@php $belumKompeten += 1; @endphp
									@endif
									@if($iskompeten['is_kompeten_from_apl_02_detail']->is_kompeten == 1)
										@php $kompeten += 1; @endphp
									@endif
								@endforeach
								@if($kompeten > $belumKompeten)
									<input type="checkbox" checked aria-label="Checkbox for following text input">
								@endif
								@php
									$kompeten = 0;
									$belumKompeten = 0;
								@endphp
							</td>
							<td class="pl-4">
								@php
									$kompeten = 0;
									$belumKompeten = 0;
									$bukti = array();
								@endphp
								@foreach($item['kuk'] as $iskompeten)
									@if($iskompeten['is_kompeten_from_apl_02_detail']->is_kompeten == 0)
										@php $belumKompeten += 1; @endphp
									@endif
									@if($iskompeten['is_kompeten_from_apl_02_detail']->is_kompeten == 1)
										@php $kompeten += 1; @endphp
									@endif
									@php $bukti[] = $iskompeten['bukti']; @endphp
								@endforeach
								@if($kompeten < $belumKompeten)
									<input type="checkbox" checked aria-label="Checkbox for following text input">
								@endif
								@php
									$kompeten = 0;
									$belumKompeten = 0;
								@endphp
							</td>
							<td>
								@php $temp = array(); @endphp
								@foreach($bukti as $itembukti)
									@php $temp[] = $itembukti @endphp
								@endforeach
								@php $buktiYangRelevan = collect($temp)->unique(); @endphp
								@foreach($buktiYangRelevan as $itemBuktiYangRelevan)
									{{ $itemBuktiYangRelevan }}
								@endforeach
							</td>
						</tr>
						@php $indexElemen++; @endphp
					@endforeach
				@php $indexUnitKompetensi++; $indexElemen = 1; @endphp
				@endforeach
			</table>
			<table border="1">
				<tr>
					<td><div class="p-2"><strong>Nama Asesi : </strong></div></td>
					<td><div class="p-2"><strong>Tanggal : </strong></div></td>
					<td><div class="p-2"><strong>Tanda Tangan Asesi : </strong></div></td>
				</tr>
				<tr>
					<td><div class="p-2">{{ $skemaSertifikasi->nama_peserta }}</div></td>
					<td><div class="p-2">{{ $skemaSertifikasi->mulai }}</div></td>
					<td>
						<div class="p-2"><strong>Belum bertanda tangan</strong></div>
						<div class="p-2">{{ $skemaSertifikasi->mulai }}</div>
					</td>
				</tr>
				<tr> 
					<td class="bg-dark text-white text-center" colspan="3"><div>Ditinjau oleh Asesor:</div></td>
				</tr>
				<tr>
					<td><div class="p-2"><strong>Nama Asesor:</strong></div></td>
					<td>
						<div class="p-2"><strong>Rekomendasi:</strong></div>
					</td>
					<td><div class="p-2"><strong>Tanda Tangan dan Tanggal:</strong></div></td>
				</tr>
				<tr>
					<td><div class="p-2">{{ $skemaSertifikasi->nama_asesor }}</div></td>
					<td>
						<div class="p-2">
							@if($data['data']['status'] == 1)
								<s>Asesmen dapat dilanjutkan</s>/ Tidak dapat dilanjutkan
							@endif
							@if($data['data']['status'] == 0)
								Asesmen dapat dilanjutkan/ <s>Tidak dapat dilanjutkan</s>
							@endif
						</div>
					</td>
					<td>
						@if($data['data']['ttd_asesor'] !== '')
							<div>
								<img class="img-fluid" src="{{ public_path('/uploads/users/signature/'. $data['data']['ttd_asesor'])}}" alt="">
							</div>
						@else
							<div><strong>Belum bertanda tangan</strong></div>
						@endif
						<div class="p-2">{{ $skemaSertifikasi->mulai }}</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>