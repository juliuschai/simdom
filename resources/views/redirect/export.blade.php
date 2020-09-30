@extends('layouts.header')

@section('content')
<div class="right_col domain" role="main">
	<div class="col-md-12 col-sm-12">
		<div style="margin-top:60px;" class="card-header">{{ __('Export') }}</div>
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

			<form id="formSubmit" action="{{route('redirect.export')}}" method="POST">
				@csrf
				<div class="form-group row">
					<label for="semuaWaktu" class="col-md-4">{{ __('Semua waktu') }}</label>
					<div class="col-md-6">
						<input id="semuaWaktu" type="checkbox" name="semuaWaktu" value="selected"
							onchange="disableWaktu()" checked disabled>
						</div>
				</div>

				<button type="submit" class="btn btn-submit">Download</button>
			</form>
		</div>
	</div>
</div>
@endsection
