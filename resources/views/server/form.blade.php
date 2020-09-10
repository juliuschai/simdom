@extends('layouts.header')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12 col-sm-12 text-center p-0 mt-3 mb-2">
			<div class="card px-0 pt-4 pb-0 mt-3 mb-3">
				<h2 id="heading">Registrasi Server</h2>
				<p>Silahkan mengengkapi formulir berikut</p>
				<form id="msform" method="POST">
					@csrf
					<!-- progressbar -->
					<ul id="progressbar">
						<li class="active" id="server"><strong>Data Server</strong></li>
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
								<label for="namaServer"
									class="col-md-4 col-form-label text-md-left">{{ __('Nama Server') }}<p
										style="color: red" class="d-inline">*</p></label>
								<i style="padding-left: 1px" class="fa fa-server domain"></i>
								<div class="col-md-6">
									<input id="namaServer" type="text" name="namaServer" class="form-control"
										value="{{$server->nama_server}}">
								</div>
							</div>

							<div class="form-group row">
								<label for="lokasiServer"
									class="col-md-4 col-form-label text-md-left">{{ __('Lokasi Server') }}</label>
								<i class="fa fa-window-maximize domain"></i>
								<div class="col-md-6">
									<input id="lokasiServer" type="text" name="lokasiServer" class="form-control"
										value="{{$server->lokasi_server}}">
								</div>
							</div>

							<div class="form-group row">
								<label for="keterangan"
									class="col-md-4 col-form-label text-md-left">{{ __('Keterangan') }}</label>
								<i class="fa fa-window-maximize domain"></i>
								<div class="col-md-6">
									<textarea id="keterangan" name="keterangan"
										class="form-control">{{$server->keterangan}}</textarea>
								</div>
							</div>
						</div>
						<button type="submit" class="next action-button">Simpan</button>
					</fieldset>
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
									<h5 class="purple-text text-center">Permintaan Server Telah Terdafdar</h5>
								</div>
							</div>
						</div>
					</fieldset>
				</form>
				@if($server->id)
				<form id="hapusForm" action="{{route('server.hapus', ['server' => $server->id])}}" method="POST">
					@csrf
					<button type="button" class="btn btn-danger" onclick="
					if (confirm('Anda yakin menghapus server?')) {document.getElementById('hapusForm').submit();}
					">Hapus</button>
				</form>
				@endif
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