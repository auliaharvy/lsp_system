 <div class="pr-4 mt-10">
	<h6>FR.MAPA.02- PETA INSTRUMEN ASESSMEN HASIL PENDEKATAN ASESMEN DAN PERENCANAAN ASESMEN</h6>
 </div>
 <div class="pr-4">
	<div class="row">
		<div class="col-12">
			<table class="table table-bordered" >
				<tr>
					<td class="bg-dark" colspan="7"></td>
				</tr>
				<tr>
					<td>
						<div>Judul</div>
					</td>
					<td>
						<div>:</div>
					</td>
					<td colspan="4">
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
					<td colspan="4">
						<div>{{ $skemaSertifikasi->kode_skema }}</div>
					</td>
				</tr>
			</table>
			<div class="table-responsive">
				<table class="table table-bordered tree" style="margin-bottom: 50px;">
					<tr>
						<td class="bg-dark text-white text-center align-middle" rowspan="{{ $kelompok_pekerjaan->count() + 1 }}">Kelompok Pekerjaan {{ $nama_kelompok_pekerjaan }}</td>
						<td class="bg-dark text-white text-center">No</td>
						<td class="bg-dark text-white text-center">Kode Unit</td>
						<td class="bg-dark text-white text-center">Judul Unit</td>
					</tr>
					@foreach($kelompok_pekerjaan as $row)
						<tr>
							<td class="text-center">{{ $loop->iteration }}</td>
							<td>{{ $row->kode_unit }}</td>
							<td>{{ $row->unit_kompetensi }}</td>
						</tr>
					@endforeach
				</table>
			</div>
				<table class="table table-bordered">
					<tr>
						<td class="bg-dark text-white text-center" rowspan="2">
							<div>No.</div>
						</td>
						<td class="bg-dark text-white text-center" rowspan="2">
							<div>
								@if ($data[0]->versi == 1)
										MUK
								@elseif ($data[0]->versi == 2)
										INSTRUMEN ASESMEN
								@else
										{{ false }}
								@endif
							</div>
						</td>
						<td class="bg-dark text-white text-center" colspan="5">
							<div>Potensi Asesi**</div>
						</td>
					</tr>
					<tr>
						<td class="bg-dark text-white text-center">
							<div>1</div>
						</td>
						<td class="bg-dark text-white text-center">
							<div>2</div>
						</td>
						<td class="bg-dark text-white text-center">
							<div>3</div>
						</td>
						<td class="bg-dark text-white text-center">
							<div>4</div>
						</td>
						<td class="bg-dark text-white text-center">
							<div>5</div>
						</td>
					</tr>
					@php $a = 1; @endphp
					@foreach($data as $mapa02)
					<tr>
						@if($a <= 4)
							<td rowspan="{{$a == 4 ? 2 : 1}}" class="{{$a == 4 ? 'align-middle' : ''}}">{{ $a }}</td>
						@elseif($a > 5)
						<td >{{ $a-1 }}</td>
						@endif
						<td>{{ $mapa02->muk }}</td>
						<td>
							@if ($mapa02->potensi_asesi_1 == 1)
							<input type="checkbox" checked aria-label="Checkbox for following text input">
							@endif
						</td>
						<td>
							@if ($mapa02->potensi_asesi_2 == 1)
							<input type="checkbox" checked aria-label="Checkbox for following text input">
							@endif
						</td>
						<td>
							@if ($mapa02->potensi_asesi_3 == 1)
							<input type="checkbox" checked aria-label="Checkbox for following text input">
							@endif
						</td>
						<td>
							@if ($mapa02->potensi_asesi_4 == 1)
							<input type="checkbox" checked aria-label="Checkbox for following text input">
							@endif
						</td>
						<td>
							@if ($mapa02->potensi_asesi_5 == 1)
							<input type="checkbox" checked aria-label="Checkbox for following text input">
							@endif
						</td>
					</tr>
					@php $a++; @endphp
					@endforeach
				</table>
				<p>*) diisi berdasarkan hasil penentuan pendekatan asesmen dan perencanaan asesmen</p>
			</div>
		</div>
	</div>
