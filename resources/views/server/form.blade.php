@extends('layouts.header')

@section('content')
<div class="right_col booking" role="main">
	<div class="col-md-12 col-sm-12">
		<div class="col-md-12 col-sm-12 text-center p-0 mt-3 mb-2">
			<div class="card px-0 pt-4 pb-0 mt-3 mb-3">
				<h2 id="heading">Registrasi Server</h2>
				<p>Silahkan mengengkapi formulir berikut</p>
				<form id="msform" method="POST">
					@csrf
					<!-- progressbar -->
					<ul id="progressbar">
                        <li class="active" id="account"><strong>Data Diri</strong></li>
						<li id="server"><strong>Data Server</strong></li>
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
                            <small>Silahkan perbaharui data diri di myits</small>
                            <div class="form-group row">
                                <label for="namaPic"
                                    class="col-md-4 col-form-label text-md-left">{{ __('Nama') }}</label>
                                <i style="padding-left: 1px" class="fa fa-user domain"></i>
                                <div class="col-md-7">
                                    <input id="namaPic" type="text" class="form-control" value="{{$user->nama}}"
                                        disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="integraPic"
                                    class="col-md-4 col-form-label text-md-left">{{ __('User Integra') }}</label>
                                <i class="fa fa-address-card domain"></i>
                                <div class="col-md-7">
                                    <input id="integraPic" type="text" class="form-control" value="{{$user->integra}}"
                                        disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="emailPic"
                                    class="col-md-4 col-form-label text-md-left">{{ __('Email ITS') }}</label>
                                <i class="fa fa-envelope domain"></i>
                                <div class="col-md-7">
                                    <input id="emailPic" type="text" class="form-control" value="{{$user->email}}"
                                        disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sivitas"
                                    class="col-md-4 col-form-label text-md-left">{{ __('Sivitas Akademika') }}</label>
                                <i class="fa fa-users domain"></i>
                                <div class="col-md-7">
                                    <input id="sivitas" type="text" class="form-control" value="{{$user->group}}"
                                        disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="noWa"
                                    class="col-md-4 col-form-label text-md-left">{{ __('No. WA') }}</label>
                                <i class="fa fa-mobile fa-2x domain"></i>
                                <div class="col-md-7">
                                    <input id="noWa" type="text" class="form-control" value="{{$user->no_wa}}" disabled>
                                </div>
                            </div>
                            @if($server->id)
                            <a href="{{route('server.transfer', ['server' => $server->id])}}">Ganti PIC server</a>
                            @endif
                        </div>
                    <input type="button" name="next" class="next action-button" value="Next" />
					</fieldset>
					<fieldset>
                        <div class="form-header">
                            <div class="row">
								<div class="col-7">
									<h2 class="fs-title">Data Server :</h2>
								</div>
								<div class="col-5">
									<h6 class="steps">Tahap 2 - 2</h6>
								</div>
							</div>
                        </div>
						<div class="form-card">
							<div class="form-group row">
								<label for="deskripsi"
									class="col-md-4 col-form-label text-md-left">{{ __('Deskripsi Server') }}<p
										style="color: red" class="d-inline">*</p></label>
								<i style="padding-left: 1px" class="fa fa-server domain"></i>
								<div class="col-md-7">
									<input id="deskripsi" type="text" name="deskripsi" class="form-control"
										value="{{$server->deskripsi}}">
								</div>
							</div>

							<div class="form-group row">
								<label for="unit"
									class="col-md-4 col-form-label text-md-left">{{ __('Fakultas/Departemen/Unit') }}<p
										style="color: red" class="d-inline">*</p></label>
								<i class="fa fa-window-maximize domain"></i>
								<div class="col-md-7">
									<two-select
										:seconds="{{$units}}"
										:firsts="{{$tipeUnits}}"
										second-val="{{old('unit')}}"
										first-val="{{old('tipeUnit')}}"

										textbox-name-prop="unit"
										first-name-prop="tipeUnit"
										>
									</two-select>
								</div>
							</div>

							<div class="form-group row">
								<label for="keperuntukan"
									class="col-md-4 col-form-label text-md-left">{{ __('Keperuntukan') }}<p
										style="color: red" class="d-inline">*</p></label>
								<i class="fa fa-window-maximize domain"></i>
								<div class="col-md-7">
									<two-select-with-textbox
										:seconds="{{$keperuntukans}}"
										:firsts="{{$tipeKeperuntukans}}"
										second-val="{{old('keperuntukan')}}"
										first-val="{{old('tipeKeperuntukan')}}"

										textbox-name-prop="keperuntukan"
										first-name-prop="tipeKeperuntukan"
										>
									</two-select-with-textbox>
								</div>
							</div>


							<div class="form-group row">
								<label for="noRack"
									class="col-md-4 col-form-label text-md-left">{{ __('No. Rack') }}</label>
								<i class="fa fa-window-maximize domain"></i>
								<div class="col-md-7">
									<input id="noRack" type="text" name="noRack" class="form-control"
										value="{{$server->no_rack}}">
								</div>
							</div>
							<small>kosongkan bila tidak diketahui</small>
						</div>
						<button type="submit" class="action-button">Simpan</button>
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
{{-- <script src="{{ asset('js/server/form.js') }}" defer></script> --}}
@endsection
