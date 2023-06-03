<div class="container">
	<h6>FR.MAPA.02- PETA INSTRUMEN ASESSMEN HASIL PENDEKATAN ASESMEN DAN PERENCANAAN ASESMEN</h6>
</div>
<div class="container">
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
			</table>
			<table class="table table-bordered mt-10">
				<tr>
					<td class="bg-dark" colspan="4"></td>
				</tr>
				<tr>
					@php $a = 1; @endphp
					@foreach($skemaUnit as $data)
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
						<div>{{ $data->kode_unit }}</div>
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
						<div>{{ $data->unit_kompetensi }}</div>
					</td>
				</tr>
				@php $a++; @endphp
				@endforeach
				</tr>
			</table>
			<table class="table table-bordered">
				<tr>
					<td class="bg-dark text-white text-center" rowspan="2">
						<div>No.</div>
					</td>
					<td class="bg-dark text-white text-center" rowspan="2">
						<div>MUK</div>
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
				{{-- <tr>
					@foreach($data as $item)
					{{ $item['potensi_asesi_1'] }}
				@endforeach
				</tr> --}}
			</table>
			<p>*) diisi berdasarkan hasil penentuan pendekatan asesmen dan perencanaan asesmen</p>
		</div>
	</div>
</div>