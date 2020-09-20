@extends('layouts.header')

@section('content')
<div class="container-fluid">
    <h2>Ganti PIC Domain</h2>

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

    <h4>PIC Sekarang</h4>
    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-left">{{ __('Nama') }}</label>
        <i style="padding-left: 1px" class="fa fa-user domain"></i>
        <div class="col-md-6">
            <input type="text" class="form-control" value="{{$pemilik->nama}}" disabled>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-left">{{ __('User Integra') }}</label>
        <i class="fa fa-address-card domain"></i>
        <div class="col-md-6">
            <input type="text" class="form-control" value="{{$pemilik->integra}}" disabled>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-left">{{ __('Email ITS') }}</label>
        <i class="fa fa-envelope domain"></i>
        <div class="col-md-6">
            <input type="text" class="form-control" value="{{$pemilik->email}}" disabled>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-left">{{ __('Sivitas Akademika') }}</label>
        <i class="fa fa-users domain"></i>
        <div class="col-md-6">
            <input type="text" class="form-control" value="{{$pemilik->group}}" disabled>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-left">{{ __('No. WA') }}</label>
        <i class="fa fa-mobile fa-2x domain"></i>
        <div class="col-md-6">
            <input type="text" class="form-control" value="{{$pemilik->no_wa}}" disabled>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-left">{{ __('Role') }}</label>
        <i class="fa fa-users domain"></i>
        <div class="col-md-6">
            <input type="text" class="form-control" value="{{$pemilik->role}}" disabled>
        </div>
    </div>

    <h4>PIC Baru</h4>
    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('Email') }}</label>
        <i style="padding-left: 1px" class="fa fa-user domain"></i>
        <div class="col-md-6">
            <input id="email" type="text" class="form-control">
        </div>
        <button type="button" class="btn btn-primary" onclick="cariUser('email')">Cari</button>
    </div>

    <div class="form-group row">
        <label for="integra" class="col-md-4 col-form-label text-md-left">{{ __('User Integra') }}</label>
        <i style="padding-left: 1px" class="fa fa-user domain"></i>
        <div class="col-md-6">
            <input id="integra" type="text" class="form-control">
        </div>
        <button type="button" class="btn btn-primary" onclick="cariUser('integra')">Cari</button>
    </div>
    
    <div class="form-group row">
        <label for="nama" class="col-md-4 col-form-label text-md-left">{{ __('Nama') }}</label>
        <i style="padding-left: 1px" class="fa fa-user domain"></i>
        <div class="col-md-6">
            <input id="nama" type="text" class="form-control" disabled>
        </div>
    </div>

    <div class="form-group row">
        <label for="no_wa" class="col-md-4 col-form-label text-md-left">{{ __('No. WA') }}</label>
        <i class="fa fa-mobile fa-2x domain"></i>
        <div class="col-md-6">
            <input id="no_wa" type="text" class="form-control" disabled>
        </div>
    </div>

    <input type="hidden" id="cariUserUrl" value="{{route('user.cari')}}">
    <input type="hidden" id="pemilikId" value="{{$pemilik->id}}">
    <form id="formElm" method="post">
        @csrf
        <input type="hidden" id="userId" name="id">
    </form>
    <button type="button" class="btn btn-danger" onclick="submitTransferForm()">Transfer</button>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/domain/transfer.js') }}" defer></script>
@endsection