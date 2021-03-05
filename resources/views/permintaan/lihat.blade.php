@extends('layouts.header')

@section('content')
<div class="right_col booking" role="main">
		<div class="col-md-12 col-sm-12 text-center p-0 mt-3 mb-2">
			<div class="card px-0 pt-4 pb-0 mt-3 mb-3">
				<h2 id="heading">Permintaan Domain</h2>
				<div id="msform">
					<!-- progressbar -->
					<ul id="progressbar">
						<li class="active" id="account"><strong>Data Diri</strong></li>
						<li id="domain"><strong>Data Domain</strong></li>
					</ul>
					@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif
					@if (session()->has('message'))
					<div class="alert alert-success">
						<ul>
							<li>{{ session()->get('message') }}</li>
						</ul>
					</div>
					@endif
					{{-- Tampilkan data diri --}}
					<fieldset>
						<div class="form-header">
							<div class="row">
								<div class="col-7">
									<h2 class="fs-title">Data Diri :</h2>
								</div>
								<div class="col-5">
									<h6 class="steps">Tahap 1 - 2</h6>
								</div>
							</div>
						</div>
						<div class="form-card">
							@if($permintaan->user->isAdmin())
							<h6>Perubahan ini dibuat oleh admin</h6>
							<div class="form-group row">
								<label for="namaPic"
									class="col-md-4 col-form-label text-md-left">{{ __('Nama') }}</label>
								<i style="padding-left: 1px" class="fa fa-user domain"></i>
								<div class="col-md-7">
									<input id="namaPic" type="text" class="form-control"
										value="{{$permintaan->user->nama}}" disabled>
								</div>
							</div>
							@else
							<div class="form-group row">
								<label for="namaPic"
									class="col-md-4 col-form-label text-md-left">{{ __('Nama') }}</label>
								<i style="padding-left: 1px" class="fa fa-user domain"></i>
								<div class="col-md-7">
									<input id="namaPic" type="text" class="form-control"
										value="{{$permintaan->user->nama}}" disabled>
								</div>
							</div>

							<div class="form-group row">
								<label for="integraPic"
									class="col-md-4 col-form-label text-md-left">{{ __('User Integra') }}</label>
								<i class="fa fa-address-card domain"></i>
								<div class="col-md-7">
									<input id="integraPic" type="text" class="form-control"
										value="{{$permintaan->user->integra}}" disabled>
								</div>
							</div>

							<div class="form-group row">
								<label for="emailPic"
									class="col-md-4 col-form-label text-md-left">{{ __('Email ITS') }}</label>
								<i class="fa fa-envelope domain"></i>
								<div class="col-md-7">
									<input id="emailPic" type="text" class="form-control"
										value="{{$permintaan->user->email}}" disabled>
								</div>
							</div>

							<div class="form-group row">
								<label for="sivitas"
									class="col-md-4 col-form-label text-md-left">{{ __('Sivitas Akademika') }}</label>
								<i class="fa fa-users domain"></i>
								<div class="col-md-7">
									<input id="sivitas" type="text" class="form-control"
										value="{{$permintaan->user->group}}" disabled>
								</div>
							</div>

							<div class="form-group row">
								<label for="noWa"
									class="col-md-4 col-form-label text-md-left">{{ __('No. WA') }}</label>
								<i class="fa fa-mobile fa-2x domain"></i>
								<div class="col-md-7">
									<input id="noWa" type="text" class="form-control"
										value="{{$permintaan->user->no_wa}}" disabled>
								</div>
							</div>
							@endif
						</div>
						<input type="button" name="next" class="next action-button" value="Next" />
					</fieldset>
					{{-- Tampilkan data domain --}}
					<fieldset>
						<div class="form-header">
							<div class="row">
								<div class="col-7">
									<h2 class="fs-title">Data Domain :</h2>
								</div>
								<div class="col-5">
									<h2 class="steps">Tahap 2 - 2</h2>
								</div>
							</div>
						</div>
						<div class="form-card">

						@admin
						@if($permintaan->status == 'menunggu' || $permintaan->status == 'ditolak')
						<form method="POST" action="{{route('permintaan.terima', $permintaan->id)}}">
							@csrf
						@endif
						@if($permintaan->status == 'diterima')
						<form method="POST" action="{{route('permintaan.selesai', $permintaan->id)}}">
							@csrf
						@endif
						@endadmin

							<div class="form-group row">
								<label for="namaDomain"
									class="col-md-4 col-form-label text-md-left">{{ __('Nama Domain') }}<p
									style="color: red" class="d-inline">*</p></label>
								<i class="fa fa-sticky-note-o domain"></i>
								<div class="col-md-7" style="margin-right:10px;">
									@admin
									<admin-nama-domain-input :templates="{{$domain_templates}}"
										sel-template-prop="{{$permintaan->unit->tipeUnit->domain_template}}"
										nama-domain-prop="{{$permintaan->nama_domain}}">
									</admin-nama-domain-input>
									@else
									<input id="namaDomain" type="text" value="{{$permintaan->nama_domain}}"
										class="form-control" disabled>
									@endif
								</div>
							</div>

							@if($permintaan->domain_id)
							<a target="_blank" href="{{route('domain.edit', ['domain' => $permintaan->domain_id])}}">
								Lihat record domain aktif dari {{$permintaan->nama_domain}}
							</a>
							@endif

							<div class="form-group row">
								<label for="deskripsi"
									class="col-md-4 col-form-label text-md-left">{{ __('Deskripsi') }}</label>
								<i class="fa fa-sticky-note-o domain"></i>
								<div class="col-md-7">
									<input id="deskripsi" type="text" name="deskripsi"
										value="{{$permintaan->deskripsi}}" class="form-control" disabled>
								</div>
							</div>

							<div class="form-group row">
								<label for="unit"
									class="col-md-4 col-form-label text-md-left">{{ __('Fakultas/Departemen/Unit') }}</label>
								<i class="fa fa-window-maximize domain"></i>
								<div class="col-md-7">
									<input id="tipeUnit" type="text" value="{{$permintaan->unit->tipeUnit->nama}}"
										class="form-control" disabled>
									<input id="unit" type="text" value="{{$permintaan->unit->nama}}"
										class="form-control" disabled>
								</div>
							</div>

							<div class="form-group row">
								<label for="surat"
									class="col-md-4 col-form-label text-md-left">{{ __('Surat') }}</label>
								<i class="fa fa-file domain"></i>
								@if(isset($permintaan->surat))
								<div class="col-md-7">
									<a href="{{route('surat.get', ['permintaan' => $permintaan->id])}}" target="_blank">
										<button type="button" class="btn btn-custom" style="padding: 4px 8px; font-size: 11pt;">View</button>
									</a>
									<a href="{{route('surat.download', ['permintaan' => $permintaan->id])}}" target="_blank">
										<button type="button" class="btn btn-custom" style="padding: 4px 8px; font-size: 11pt;">Download</button>
									</a>
								</div>
								@else
								<div class="col-md-7">
									Tidak ada surat
								</div>
								@endif
							</div>

							<div class="form-group row">
								<label for="server"
									class="col-md-4 col-form-label text-md-left">{{ __('Server') }}</label>
								<i class="fa fa-server domain"></i>
								<div class="col-md-7">
									<input id="server" type="text" class="form-control" value="{{$permintaan->server}}"
										disabled>
								</div>
							</div>

							<div class="form-group row">
								<label for="kapasitas"
									class="col-md-4 col-form-label text-md-left">{{ __('Kapasitas (Kuota DB)') }}</label>
								<i class="fa fa-database domain"></i>
								<div class="col-md-7">
									<input id="kapasitas" type="text" value="{{$permintaan->kapasitas}}"
										class="form-control" disabled>(GB)
								</div>
							</div>

							<div class="form-group row">
								<label for="keterangan"
									class="col-md-4 col-form-label text-md-left">{{ __('Keterangan') }}</label>
								<i class="fa fa-inbox domain"></i>
								<div class="col-md-7">
									<textarea id="keterangan" type="text" class="form-control"
										disabled>{{$permintaan->keterangan}}</textarea>
								</div>
							</div>

							<div class="form-group row">
								<label for="status"
									class="col-md-4 col-form-label text-md-left">{{ __('Status') }}</label>
								<i class="fa fa-database domain"></i>
								<div class="col-md-7">
									<input id="status" type="text" value="{{$permintaan->status}}" class="form-control"
										disabled>
								</div>
							</div>

							@admin
							@if($permintaan->status == 'menunggu' || $permintaan->status == 'ditolak' || $permintaan->status == 'diterima')
							<div class="form-group row">
								<label for="ip"
									class="col-md-4 col-form-label text-md-left">{{ __('IP Address') }}</label>
								<i class="fa fa-inbox domain"></i>
								<div class="col-md-7">
									<input id="ip" name="ip" type="text" value="{{$permintaan->ip}}"
										class="form-control">
								</div>
							</div>

							@if($permintaan->status == 'menunggu' || $permintaan->status == 'ditolak')
							<button type="submit" class="next action-terima">Terima</button>
							@endif
							@if($permintaan->status == 'diterima')
							<button type="submit" class="next action-selesai">Selesai</button>
							@endif
						</form>
							@endif
							@endadmin

							@admin
							@if($permintaan->status == 'menunggu' || $permintaan->status == 'diterima')
							<form id="tolakForm" method="POST" action="{{route('permintaan.tolak', $permintaan->id)}}">
								@csrf
								<button type="button" class="previous action-tolak" onclick="
								if (confirm('Anda yakin menolak permintaan?')) {document.getElementById('tolakForm').submit();}
								">Tolak</button>
							</form>
							@endif
							@if($permintaan->status == 'menunggu')
							<form id="hapusForm" method="POST" action="{{route('permintaan.hapus', $permintaan->id)}}">
								@csrf
								<button type="button" class="previous action-hapus" onclick="
								if (confirm('Anda akan menghapus permintaan! Lanjutkan?')) {document.getElementById('hapusForm').submit();}
								">Hapus</button>
							</form>
							@endif
							@endadmin

							<!-- @admin
							{{-- Domain Table Unit Search Start --}}
							<button type="button" id="showTableButton" class="action-lihat"
								onclick="initTable()">Lihat semua domain dari {{$permintaan->unit->nama}}</button>
							<div id="ipTableSection" style="display: none;">
								<hr />
								<div style="margin-left: 400px;">Domain Aktif dengan VPS dari {{$permintaan->unit->nama}}</div>
								<table id="tableElm" data-server="VPS" data-unit="{{$permintaan->unit->id}}"
									data-status="aktif" data-ajaxurl="{{route('permintaan.lihat.data')}}">
									<thead>
										<td>Id</td>
										<td>Unit</td>
										<td>Server</td>
										<td>Status</td>
										<td>Domain</td>
										<td>Kapasitas DB</td>
										<td>Ip</td>
										<td>Aksi</td>
									</thead>
									<tbody></tbody>
								</table>
							</div>
							@endadmin -->
						</div>
						<button type="button" class="previous action-previous">Previous</button>
						@admin
							{{-- Domain Table Unit Search Start --}}
							<button type="button" id="showTableButton" class="action-lihat"
								onclick="initTable()">Lihat semua domain dari {{$permintaan->unit->nama}}</button>
							<div id="ipTableSection" style="display: none;">
								<hr />
								<div style="margin-left: 400px;">Domain Aktif dengan VPS dari {{$permintaan->unit->nama}}</div>
								<table id="tableElm" data-server="VPS" data-unit="{{$permintaan->unit->id}}"
									data-status="aktif" data-ajaxurl="{{route('permintaan.lihat.data')}}">
									<thead>
										<td>Id</td>
										<td>Unit</td>
										<td>Server</td>
										<td>Status</td>
										<td>Domain</td>
										<td>Kapasitas DB</td>
										<td>Ip</td>
										<td>Aksi</td>
									</thead>
									<tbody></tbody>
								</table>
							</div>
							@endadmin
					</fieldset>
				</div>
			</div>
		</div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/form/bootstrap.min.js') }}" defer></script>
<script src="{{ asset('js/form/jquery.min.js') }}" defer></script>
<script src="{{ asset('js/fieldset.js') }}" defer></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css" defer />
<script src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js" defer></script>
<script src="{{ asset('js/permintaan/lihat.js') }}" defer></script>
@endsection
