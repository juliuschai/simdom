@extends('layouts.header')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12 col-sm-12 text-center p-0 mt-3 mb-2">
			<div class="card px-0 pt-4 pb-0 mt-3 mb-3">
				<h2 id="heading">Redirect Record</h2>
				<form id="msform" method="POST">
					@csrf
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

                    <div class="form-card">

                        <div class="form-group row">
                            <label for="linkLama"
                                class="col-md-4 col-form-label text-md-left">{{ __('Link Lama') }}<p
                                style="color: red" class="d-inline">*</p></label>
                            <i class="fa fa-window-maximize domain"></i>
                            <div class="col-md-6">
                                <input id="linkLama" type="text" name="linkLama" class="form-control"
                                    value="{{$redirect->link_lama}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="linkBaru"
                                class="col-md-4 col-form-label text-md-left">{{ __('Link Baru') }}<p
                                style="color: red" class="d-inline">*</p></label>
                            <i class="fa fa-window-maximize domain"></i>
                            <div class="col-md-6">
                                <input id="linkBaru" type="text" name="linkBaru" class="form-control"
                                    value="{{$redirect->link_baru}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keterangan"
                                class="col-md-4 col-form-label text-md-left">{{ __('Keterangan') }}</label>
                            <i style="padding-left: 1px" class="fa fa-server domain"></i>
                            <div class="col-md-6">
                                <input id="keterangan" type="text" name="keterangan" class="form-control"
                                    value="{{$redirect->keterangan}}">
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="action-button">Simpan</button>
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