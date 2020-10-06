@extends('layouts.header')

@section('content')
<div class="right_col domain" role="main">
	<div class="col-md-12 col-sm-12">
		<div class="card px-5 pt-4 pb-3">
		<div class="header-custom">{{ __('Export') }}</div>
			<div class="card-body">
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif

				<form id="formSubmit" action="{{route('permintaan.export')}}" method="POST">
					@csrf
					<div class="form-group row">
						<label for="semuaWaktu" class="col-md-4">{{ __('Semua waktu') }}</label>
						<div class="col-md-6"><input id="semuaWaktu" type="checkbox" name="semuaWaktu" value="selected" onchange="disableWaktu()" ></div>
					</div>

					<div class="form-group row">
						<label for="bulanMulai" class="col-md-4">{{ __('Dari Bulan') }}</label>
						<div class="col-md-6"><input id="bulanMulai" type="month" class="form-control" onchange="updateWaktu()"></div>
					</div>

					<div class="form-group row">
						<label for="bulanAkhir" class="col-md-4">{{ __('Sampai Bulan') }}</label>
						<div class="col-md-6"><input id="bulanAkhir" type="month" class="form-control" onchange="updateWaktu()"></div>
					</div>

					<input id="waktuMulai" name="waktuMulai" type="hidden">
					<input id="waktuAkhir" name="waktuAkhir" type="hidden">

					<button type="button" class="btn btn-custom" onclick="submitForm()">Download</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/util/export.js') }}?2" defer></script>
@endsection