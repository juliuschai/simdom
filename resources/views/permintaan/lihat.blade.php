@extends('layouts.header')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12 col-sm-12 text-center p-0 mt-3 mb-2">
			<div class="card px-0 pt-4 pb-0 mt-3 mb-3">
				<h2 id="heading">Permintaan Domain</h2>
				<p>Silahkan mengengkapi formulir berikut</p>
				<div id="msform">
					<!-- progressbar -->
					<ul id="progressbar">
						<li class="active" id="account"><strong>Data Diri</strong></li>
						<li id="domain"><strong>Data Domain</strong></li>
						<li id="confirm"><strong>Selesai</strong></li>
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
						<div class="form-card">
							<div class="row">
								<div class="col-7">
									<h2 class="fs-title">Data Diri :</h2>
								</div>
								<div class="col-5">
									<h6 class="steps">Tahap 1 - 3</h6>
								</div>
							</div>
							@if($permintaan->user->isAdmin())
							<h6>Perubahan ini dibuat oleh admin</h6>
							<div class="form-group row">
								<label for="namaPic"
									class="col-md-4 col-form-label text-md-left">{{ __('Nama') }}</label>
								<i style="padding-left: 1px" class="fa fa-user domain"></i>
								<div class="col-md-6">
									<input id="namaPic" type="text" class="form-control"
										value="{{$permintaan->user->nama}}" disabled>
								</div>
							</div>
							@else
							<div class="form-group row">
								<label for="namaPic"
									class="col-md-4 col-form-label text-md-left">{{ __('Nama') }}</label>
								<i style="padding-left: 1px" class="fa fa-user domain"></i>
								<div class="col-md-6">
									<input id="namaPic" type="text" class="form-control"
										value="{{$permintaan->user->nama}}" disabled>
								</div>
							</div>

							<div class="form-group row">
								<label for="integraPic"
									class="col-md-4 col-form-label text-md-left">{{ __('User Integra') }}</label>
								<i class="fa fa-address-card domain"></i>
								<div class="col-md-6">
									<input id="integraPic" type="text" class="form-control"
										value="{{$permintaan->user->integra}}" disabled>
								</div>
							</div>

							<div class="form-group row">
								<label for="emailPic"
									class="col-md-4 col-form-label text-md-left">{{ __('Email ITS') }}</label>
								<i class="fa fa-envelope domain"></i>
								<div class="col-md-6">
									<input id="emailPic" type="text" class="form-control"
										value="{{$permintaan->user->email}}" disabled>
								</div>
							</div>

							<div class="form-group row">
								<label for="sivitas"
									class="col-md-4 col-form-label text-md-left">{{ __('Sivitas Akademika') }}</label>
								<i class="fa fa-users domain"></i>
								<div class="col-md-6">
									<input id="sivitas" type="text" class="form-control"
										value="{{$permintaan->user->group}}" disabled>
								</div>
							</div>

							<div class="form-group row">
								<label for="noWa"
									class="col-md-4 col-form-label text-md-left">{{ __('No. WA') }}</label>
								<i class="fa fa-mobile fa-2x domain"></i>
								<div class="col-md-6">
									<input id="noWa" type="text" class="form-control"
										value="{{$permintaan->user->no_wa}}" disabled>
								</div>
							</div>
							@endif
						</div> <input type="button" name="next" class="next action-button" value="Next" />
					</fieldset>
					{{-- Tampilkan data domain --}}
					<fieldset>
						<div class="form-card">
							<div class="row">
								<div class="col-7">
									<h2 class="fs-title">Data Domain :</h2>
								</div>
								<div class="col-5">
									<h2 class="steps">Tahap 2 - 3</h2>
								</div>
							</div>

							<div class="form-group row">
								<label for="namaDomain"
									class="col-md-4 col-form-label text-md-left">{{ __('Nama Domain') }}</label>
								<i class="fa fa-sticky-note-o domain"></i>
								<div class="col-md-6">
									<input id="namaDomain" type="text" name="namaDomain"
										value="{{$permintaan->nama_domain}}" class="form-control" disabled>
								</div>
							</div>

							@if($permintaan->domain_id)
							<a target="_blank" href="{{route('domain.edit', ['domain' => $permintaan->domain_id])}}" >
								Lihat record domain aktif dari {{$permintaan->nama_domain}}
							</a>
							@endif

							<div class="form-group row">
								<label for="deskripsi"
									class="col-md-4 col-form-label text-md-left">{{ __('Deskripsi') }}<p
										style="color: red" class="d-inline">*</p></label>
								<i class="fa fa-sticky-note-o domain"></i>
								<div class="col-md-6">
									<input id="deskripsi" type="text" name="deskripsi"
										value="{{$permintaan->deskripsi}}" class="form-control" disabled>
								</div>
							</div>

							<div class="form-group row">
								<label for="unit"
									class="col-md-4 col-form-label text-md-left">{{ __('Fakultas/Departemen/Unit') }}</label>
								<i class="fa fa-window-maximize domain"></i>
								<div class="col-md-6">
									<input id="tipeUnit" type="text" value="{{$permintaan->unit->tipeUnit->nama}}"
										class="form-control" disabled>
									<input id="unit" type="text" value="{{$permintaan->unit->nama}}"
										class="form-control" disabled>
								</div>
							</div>
                            @admin
                            <a href="{{route('domain.list', ['q' => $permintaan->unit->nama])}}">Lihat semua domain dari unit tersebut</a>
                            @endadmin

							<div class="form-group row">
								<label for="surat"
									class="col-md-4 col-form-label text-md-left">{{ __('Surat') }}</label>
								<i class="fa fa-file booking"></i>
								@if(isset($permintaan->surat))
								<div class="col-md-6">
									<a href="{{route('surat.get', ['id' => $permintaan->id])}}" target="_blank"><button
											style="background-color: #0067ac !important; color: white !important;"
											class="btn">View</button></a>
									<a href="{{route('surat.download', ['id' => $permintaan->id])}}"
										target="_blank"><button
											style="background-color: #0067ac !important; color: white !important;"
											class="btn">Download</button></a>
								</div>
								@else
								<div class="col-md-6">
									Tidak ada surat
								</div>
								@endif
							</div>

							<div class="form-group row">
								<label for="server"
									class="col-md-4 col-form-label text-md-left">{{ __('Server') }}</label>
								<i class="fa fa-server domain"></i>
								<div class="col-md-6">
									<input id="server" type="text" class="form-control"
										value="{{$permintaan->server->nama}}" disabled>
								</div>
							</div>

							<div class="form-group row">
								<label for="kapasitas"
									class="col-md-4 col-form-label text-md-left">{{ __('Kapasitas (Kuota DB)') }}</label>
								<i class="fa fa-database domain"></i>
								<div class="col-md-6">
									<input id="kapasitas" type="text" value="{{$permintaan->kapasitas}}"
										class="form-control" disabled>(GB)
								</div>
							</div>

							<div class="form-group row">
								<label for="keterangan"
									class="col-md-4 col-form-label text-md-left">{{ __('Keterangan') }}</label>
								<i class="fa fa-inbox domain"></i>
								<div class="col-md-6">
									<textarea id="keterangan" type="text" class="form-control"
										disabled>{{$permintaan->keterangan}}</textarea>
								</div>
							</div>

							<div class="form-group row">
								<label for="status"
									class="col-md-4 col-form-label text-md-left">{{ __('Status') }}</label>
								<i class="fa fa-database domain"></i>
								<div class="col-md-6">
									<input id="status" type="text" value="{{$permintaan->status}}" class="form-control"
										disabled>
								</div>
							</div>

                            @admin
							@if($permintaan->status == 'menunggu'
							|| $permintaan->status == 'ditolak')
							<form method="POST" action="{{route('permintaan.terima', $permintaan->id)}}">
								@csrf
								<div class="form-group row">
									<label for="ipAddress"
										class="col-md-4 col-form-label text-md-left">{{ __('IP Address') }}</label>
									<i class="fa fa-inbox domain"></i>
									<div class="col-md-6">
										<input id="ipAddress" name="ipAddress" type="text"
											value="{{$permintaan->ip}}" class="form-control">
									</div>
								</div>
								<button type="submit" class="next action-button">Terima</button>
							</form>
							@endif
							@if($permintaan->status == 'diterima')
							<form method="POST" action="{{route('permintaan.selesai', $permintaan->id)}}">
								@csrf
								<div class="form-group row">
									<label for="ipAddress"
										class="col-md-4 col-form-label text-md-left">{{ __('IP Address') }}</label>
									<i class="fa fa-inbox domain"></i>
									<div class="col-md-6">
										<input id="ipAddress" name="ipAddress" type="text"
											value="{{$permintaan->ip}}" class="form-control">
									</div>
								</div>
								<button type="submit" class="next action-button">Selesai</button>
							</form>
							@endif
							@if($permintaan->status == 'menunggu'
							|| $permintaan->status == 'diterima')
							<form id="tolakForm" method="POST" action="{{route('permintaan.tolak', $permintaan->id)}}">
								@csrf
								<button type="button" class="previous action-button-previous" onclick="
								if (confirm('Anda yakin menolak permintaan?')) {document.getElementById('tolakForm').submit();}
								">Tolak</button>
							</form>
							@endif
							@if($permintaan->status == 'menunggu')
							<form id="hapusForm" method="POST" action="{{route('permintaan.hapus', $permintaan->id)}}">
								@csrf
								<button type="button" class="previous action-button-previous" onclick="
								if (confirm('Anda akan menghapus permintaan! Lanjutkan?')) {document.getElementById('hapusForm').submit();}
								">Hapus</button>
							</form>
							@endif
                            @endadmin
							<button type="button" class="previous action-button-previous">Prev</button>
						</div>
					</fieldset>
					{{-- Tampilkan selesai view --}}
					<fieldset>
						<div class="form-card">
							<br><br>
							<h2 class="purple-text text-center"><strong>SELAMAT !</strong></h2> <br>
							<div class="row justify-content-center">
								<div class="col-3"> <img src="{{ asset('img/icon/check-mark.png') }}" class="fit-image">
								</div>
							</div> <br><br>
							<div class="row justify-content-center">
								<div class="col-7 text-center">
									<h5 class="purple-text text-center">Permintaan Domain Telah Terdafdar</h5>
								</div>
							</div>
						</div>
					</fieldset>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/form/bootstrap.min.js') }}" defer></script>
<script src="{{ asset('js/form/jquery.min.js') }}" defer></script>
<script src="{{ asset('js/fieldset.js') }}" defer></script>
@endsection