
@extends('layouts.header')

@section('content')
<div class="right_col booking" role="main">
	<div class="col-md-12 col-sm-12">
		<div class="col-md-12 col-sm-12 text-center p-0 mt-3 mb-2">
			<div class="card px-0 pt-4 pb-0 mt-3 mb-3">
				<h2 id="heading">Registrasi Domain</h2>
				<p>Silahkan mengengkapi formulir berikut</p>
				<form id="msform" action="{{route('domain.baru')}}" method="POST" enctype="multipart/form-data">
					@csrf
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
					{{-- Tampilkan data diri --}}
					<fieldset>
						<div class="form-card">
							<div class="row">
								<div class="col-7">
									<h2 class="fs-title">Data Diri :</h2>
								</div>
								<div class="col-5">
									<h6 class="steps">Tahap 1 - 2</h6>
								</div>
							</div>
							<small>Silahkan perbaharui data diri di myits</small>
							<div class="form-group row">
								<label for="namaPic"
									class="col-md-4 col-form-label text-md-left">{{ __('Nama') }}</label>
								<i style="padding-left: 1px" class="fa fa-user domain"></i>
								<div class="col-md-6">
									<input id="namaPic" type="text" class="form-control" value="{{$user->nama}}"
										disabled>
								</div>
							</div>

							<div class="form-group row">
								<label for="integraPic"
									class="col-md-4 col-form-label text-md-left">{{ __('User Integra') }}</label>
								<i class="fa fa-address-card domain"></i>
								<div class="col-md-6">
									<input id="integraPic" type="text" class="form-control" value="{{$user->integra}}"
										disabled>
								</div>
							</div>

							<div class="form-group row">
								<label for="emailPic"
									class="col-md-4 col-form-label text-md-left">{{ __('Email ITS') }}</label>
								<i class="fa fa-envelope domain"></i>
								<div class="col-md-6">
									<input id="emailPic" type="text" class="form-control" value="{{$user->email}}"
										disabled>
								</div>
							</div>

							<div class="form-group row">
								<label for="sivitas"
									class="col-md-4 col-form-label text-md-left">{{ __('Sivitas Akademika') }}</label>
								<i class="fa fa-users domain"></i>
								<div class="col-md-6">
									<input id="sivitas" type="text" class="form-control" value="{{$user->group}}"
										disabled>
								</div>
							</div>

							<div class="form-group row">
								<label for="noWa"
									class="col-md-4 col-form-label text-md-left">{{ __('No. WA') }}</label>
								<i class="fa fa-mobile fa-2x domain"></i>
								<div class="col-md-6">
									<input id="noWa" type="text" class="form-control" value="{{$user->no_wa}}" disabled>
								</div>
							</div>
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
									<h2 class="steps">Tahap 2 - 2</h2>
								</div>
							</div>

							<div class="form-group row">
								<label for="deskripsi"
									class="col-md-4 col-form-label text-md-left">{{ __('Deskripsi') }}<p
										style="color: red" class="d-inline">*</p></label>
								<i class="fa fa-sticky-note-o domain"></i>
								<div class="col-md-6">
									<input id="deskripsi" type="text" name="deskripsi" value="{{old('deskripsi')}}"
										class="form-control" placeholder="BEM ITS; Gemastik; Biro Administrasi Pembelajaran Mahasiswa">
								</div>
							</div>

							<div class="form-group row">
								<label for="unit"
									class="col-md-4 col-form-label text-md-left">{{ __('Fakultas/Departemen/Unit') }}<p
										style="color: red" class="d-inline">*</p></label>
								<i class="fa fa-window-maximize domain"></i>
								<div class="col-md-6">
									<two-select-with-textbox 
										:seconds="{{$units}}" 
										:firsts="{{$tipeUnits}}"
										second-val="{{old('unit')}}"
										first-val="{{old('tipeUnit')}}"

										textbox-name-prop="unit"
										first-name-prop="tipeUnit"
										>
									</two-select-with-textbox>
								</div>
							</div>

							<div class="form-group row">
								<label for="surat"
									class="col-md-4 col-form-label text-md-left">{{ __('Surat') }}</label>
								<i class="fa fa-file booking" style="margin-left: -10px; margin-top: 10px"></i>
								<div class="col-md-6">
									<input style="border: none;" id="surat" type="file" name="surat"
										class="form-control">
								</div>
							</div>

							<div class="form-group row">
								<label for="serverDomain" class="col-md-4 col-form-label text-md-left">{{ __('Tipe Server') }}
									<p style="color: red" class="d-inline">*</p></label>
								<i class="fa fa-server domain"></i>
								<div class="col-md-6">
									<select id="serverDomain" name="serverDomain" class="form-control" data-value="{{old('serverDomain')}}">
										<option value="WHS">WHS/Zeus/CPanel</option>
										<option value="VPS">VPS</option>
										<option value="Colocation">Colocation</option>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label for="kapasitas"
									class="col-md-4 col-form-label text-md-left">{{ __('Kapasitas (Kuota DB)') }}<p
										style="color: red" class="d-inline">*</p></label>
								<i class="fa fa-database domain"></i>
								<div class="col-md-6">
									<input id="kapasitas" type="text" name="kapasitas"
										value="{{old('kapasitas')??'64'}}" class="form-control d-inline"
										style="width: 15%; margin-right:10px;">
										(GB)
								</div>
							</div>

							<div class="form-group row">
								<label for="keterangan"
									class="col-md-4 col-form-label text-md-left">{{ __('Keterangan') }}<p
										style="color: red" class="d-inline">*</p></label>
								<i class="fa fa-inbox domain"></i>
								<div class="col-md-6">
									<textarea id="keterangan" type="text" name="keterangan" class="form-control"
										placeholder="Pembuatan domain baru; Penambahan kuota DB; Pergantian nama domain;">{{old('keterangan')}}</textarea>
								</div>
							</div>

						</div>
						<button type="button" class="action-button" onclick="submitForm()">Buat</button>
						{{-- <input type="button" name="next" class="next action-button" value="Next" />  --}}
						<input type="button" name="previous" class="previous action-button-previous" value="Previous" />
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/form/bootstrap.min.js') }}" defer></script>
<script src="{{ asset('js/form/jquery.min.js') }}" defer></script>
<script src="{{ asset('js/fieldset.js') }}" defer></script>
<script src="{{ asset('js/domain/form.js') }}" defer></script>
@endsection