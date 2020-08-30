@extends('layouts.header')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2 id="heading">Registrasi Server</h2>
                <p>Silahkan mengengkapi formulir berikut</p>
                <form id="msform" class="domainTimesForm">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active" id="server"><strong>Data Server</strong></li>
                        <li id="detailServer"><strong>Detail Server</strong></li>
                        <li id="locationServer"><strong>Lokasi Server</strong></li>
                        <li id="confirm"><strong>Selesai</strong></li>
                    </ul>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Data Server :</h2>
                                </div>
                                <div class="col-5">
                                    <h6 class="steps">Tahap 1 - 3</h6>
                                </div>
                            </div> 
                            <div class="form-group row">
								<label for="namaPic" class="col-md-4 col-form-label text-md-left">{{ __('Nama Server') }}<p style="color: red" class="d-inline">*</p></label>
								<i style="padding-left: 1px" class="fa fa-server domain"></i>
								<div class="col-md-6">
									<input 
										id="namaPic" type="text" class="form-control" 
										value="" disabled
									>
								</div>
							</div>

							<div class="form-group row">
								<label for="integraPic" class="col-md-4 col-form-label text-md-left">{{ __('Tipe/Merek Server') }}<p style="color: red" class="d-inline">*</p></label>
								<i class="fa fa-window-maximize domain"></i>
								<div class="col-md-6">
									<select name="kategoriAcara" class="form-control">
												<option value=""></option>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label for="emailPic" class="col-md-4 col-form-label text-md-left">{{ __('Tanggal Mulai Aktif') }}<p style="color: red" class="d-inline">*</p></label>
								<i class="fa fa-calendar domain"></i>
								<div class="col-md-6">
									<input type="date" class="col-md-7 mulaiDate d-inline" style="margin-right:5px" onclick="updateWaktu(this)">
									<select class="col-md-4 mulaiTime" onclick="updateWaktu(this)"></select>
								</div>
							</div>

							<div class="form-group row">
								<label for="sivitas" class="col-md-4 col-form-label text-md-left">{{ __('Sumber Dana/Hibah') }}<p style="color: red" class="d-inline">*</p></label>
								<i class="fa fa-money domain"></i>
								<div class="col-md-6">
									<input 
										id="sivitas" type="text" class="form-control" 
										value="" disabled
									>
								</div>
							</div>

                        </div> <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Detail Server :</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Tahap 2 - 3</h2>
                                </div>
                            </div> 
                            <div class="form-group row">
								<label for="namaPic" class="col-md-4 col-form-label text-md-left">{{ __('Jumlah Processor') }}<p style="color: red" class="d-inline">*</p></label>
								<i style="padding-left: 1px" class="fa fa-television domain"></i>
								<div class="col-md-6">
                                    <input type="date" class="col-md-7 mulaiDate d-inline" style="margin-right:5px" onclick="updateWaktu(this)">
									<select class="col-md-4 mulaiTime" onclick="updateWaktu(this)"></select>
								</div>
							</div>

							<div class="form-group row">
								<label for="integraPic" class="col-md-4 col-form-label text-md-left">{{ __('Tipe Processor') }}<p style="color: red" class="d-inline">*</p></label>
								<i class="fa fa-desktop domain"></i>
								<div class="col-md-6">
									<select name="kategoriAcara" class="form-control">
												<option value=""></option>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label for="emailPic" class="col-md-4 col-form-label text-md-left">{{ __('Jumlah HDD') }}<p style="color: red" class="d-inline">*</p></label>
								<i class="fa fa-bars domain"></i>
								<div class="col-md-6">
                                    <select name="kategoriAcara" class="form-control">
												<option value=""></option>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label for="sivitas" class="col-md-4 col-form-label text-md-left">{{ __('Tipe HDD') }}<p style="color: red" class="d-inline">*</p></label>
								<i class="fa fa-hdd-o domain"></i>
								<div class="col-md-6">
									<select name="kategoriAcara" class="form-control">
												<option value=""></option>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label for="noWa" class="col-md-4 col-form-label text-md-left">{{ __('Jumlah Memori') }}<p style="color: red" class="d-inline">*</p></label>
								<i class="fa fa-window-minimize domain"></i>
								<div class="col-md-6">
									<input 
										id="noWa" type="text" class="form-control"
										value=""
									>
							    </div>
							</div>
							
							<div class="form-group row">
								<label for="noWa" class="col-md-4 col-form-label text-md-left">{{ __('Tipe Memori') }}<p style="color: red" class="d-inline">*</p></label>
								<i class="fa fa-window-restore domain"></i>
								<div class="col-md-6">
									<select name="kategoriAcara" class="form-control">
												<option value=""></option>
									</select>
							    </div>
                            </div>
                        </div> <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Lokasi Server:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Tahap 3 - 4</h2>
                                </div>
                            </div> 
                            <div class="form-group row">
								<label for="namaPic" class="col-md-4 col-form-label text-md-left">{{ __('Lokasi Server') }}<p style="color: red" class="d-inline">*</p></label>
								<i style="padding-left: 1px" class="fa fa-archive domain"></i>
								<div class="col-md-6">
                                    <input type="date" class="col-md-7 mulaiDate d-inline" style="margin-right:5px" onclick="">
									<select class="col-md-4 mulaiTime" onclick=""></select>
								</div>
							</div>

							<div class="form-group row">
								<label for="integraPic" class="col-md-4 col-form-label text-md-left">{{ __('No Rack') }}<p style="color: red" class="d-inline">*</p></label>
								<i class="fa fa-tasks domain"></i>
								<div class="col-md-6">
									<input 
										id="integraPic" type="text" class="form-control"  
										value="" 
									>
								</div>
							</div>

							<div class="form-group row">
								<label for="emailPic" class="col-md-4 col-form-label text-md-left">{{ __('Keterangan') }}<p style="color: red" class="d-inline">*</p></label>
								<i class="fa fa-inbox domain"></i>
								<div class="col-md-6">
                                    <input type="date" class="col-md-7 mulaiDate d-inline" style="margin-right:5px" onclick="">
									<select class="col-md-4 mulaiTime" onclick=""></select>
								</div>
							</div>

                        </div> <input type="button" name="next" class="next action-button" value="Submit" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <br><br>
                            <h2 class="purple-text text-center"><strong>SELAMAT !</strong></h2> <br>
                            <div class="row justify-content-center">
                                <div class="col-3"> <img src="{{ asset('img/icon/check-mark.png') }}" class="fit-image"> </div>
                            </div> <br><br>
                            <div class="row justify-content-center">
                                <div class="col-7 text-center">
                                    <h5 class="purple-text text-center">Permintaan Server Telah Terdafdar</h5>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/domain/form.js') }}" defer></script>
<script src="{{ asset('js/form/view.js') }}" defer></script>
<script src="{{ asset('js/form/bootstrap.min.js') }}" defer></script>
<script src="{{ asset('js/form/jquery.min.js') }}" defer></script>
@endsection