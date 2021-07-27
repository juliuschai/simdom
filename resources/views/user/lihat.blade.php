@extends('layouts.header')

@section('content')
<div class="right_col booking" role="main">
    <div class="col-md-12 col-sm-12 text-center p-0 mt-3 mb-2">
	    <div class="card px-5 pt-4 pb-3">
        <div class="header-custom">{{ __('Edit User') }}</div>
    <div class="form-group row">
        <label for="namaPic" class="col-md-4 col-form-label text-md-left">{{ __('Nama') }}</label>
        <i style="padding-left: 1px" class="fa fa-user domain"></i>
        <div class="col-md-6">
            <input id="namaPic" type="text" class="form-control" value="{{$user->nama}}">
        </div>
    </div>

    <div class="form-group row">
        <label for="integraPic" class="col-md-4 col-form-label text-md-left">{{ __('User Integra') }}</label>
        <i class="fa fa-address-card domain"></i>
        <div class="col-md-6">
            <input id="integraPic" type="text" class="form-control" value="{{$user->integra}}">
        </div>
    </div>

    <div class="form-group row">
        <label for="emailPic" class="col-md-4 col-form-label text-md-left">{{ __('Email ITS') }}</label>
        <i class="fa fa-envelope domain"></i>
        <div class="col-md-6">
            <input id="emailPic" type="text" class="form-control" value="{{$user->email}}">
        </div>
    </div>

    <div class="form-group row">
        <label for="sivitas" class="col-md-4 col-form-label text-md-left">{{ __('Sivitas Akademika') }}</label>
        <i class="fa fa-users domain"></i>
        <div class="col-md-6">
            <input id="sivitas" type="text" class="form-control" value="{{$user->group}}">
        </div>
    </div>

    <div class="form-group row">
        <label for="noWa" class="col-md-4 col-form-label text-md-left">{{ __('No. WA') }}</label>
        <i class="fa fa-mobile fa-2x domain"></i>
        <div class="col-md-6">
            <input id="noWa" type="text" class="form-control" value="{{$user->no_wa}}">
        </div>
    </div>

    <div class="form-group row">
        <label for="role" class="col-md-4 col-form-label text-md-left">{{ __('Role') }}</label>
        <i class="fa fa-users domain"></i>
        <div class="col-md-6">
            <input id="role" type="text" class="form-control" value="{{$user->role}}">
        </div>
    </div>

    <div class="form-group row">
        <label for="notif_layanan" class="col-md-4 col-form-label text-md-left">{{ __('Notif Layanan') }}</label>
        <i class="fa fa-users domain"></i>
        <div class="col-md-6">
            <input id="notif_layanan" type="text" class="form-control" value="{{$user->notif_layanan ? 'iya' : 'tidak'}}">
        </div>
    </div>

    <div class="form-group row">
        <label for="notif_jaringan" class="col-md-4 col-form-label text-md-left">{{ __('Notif Jaringan') }}</label>
        <i class="fa fa-users domain"></i>
        <div class="col-md-6">
            <input id="notif_jaringan" type="text" class="form-control" value="{{$user->notif_jaringan ? 'iya' : 'tidak'}}">
        </div>
    </div>

    {{-- Role settings --}}
    @if($user->role != 'admin')
    <form method="POST" action="{{ route('user.role', ['user' => $user->id, 'role' => 'admin']) }}">
        @csrf
        <button type="submit" class="btn btn-danger">Jadikan Admin</button>
    </form>
    @endif
    @if($user->role != 'user')
    <form method="POST" action="{{ route('user.role', ['user' => $user->id, 'role' => 'user']) }}">
        @csrf
        <button type="submit" class="btn btn-success" style="margin-bottom: 5px; padding: 4px 8px;font-size: 11pt;">Jadikan User</button>
    </form>

    {{-- Email notification Tim Layanan --}}
    @if($user->notif_layanan)
    <form method="POST" action="{{ route('user.notif.layanan', ['user' => $user->id, 'notif' => 'false']) }}">
        @csrf
        <button type="submit" class="btn btn-custom-warning" style="margin-bottom: 5px; padding: 4px 8px;font-size: 11pt;">Hentikan email notifikasi tim layanan user</button>
    </form>
    @else
    <form method="POST" action="{{ route('user.notif.layanan', ['user' => $user->id, 'notif' => 'true']) }}">
        @csrf
        <button type="submit" class="btn btn-danger" style="padding: 4px 8px;font-size: 11pt;">Email notifikasi tim layanan user untuk permintaan baru</button>
    </form>
    @endif

    {{-- Email notification Tim jaringan --}}
    @if($user->notif_jaringan)
    <form method="POST" action="{{ route('user.notif.jaringan', ['user' => $user->id, 'notif' => 'false']) }}">
        @csrf
        <button type="submit" class="btn btn-custom-warning" style="margin-bottom: 5px; padding: 4px 8px;font-size: 11pt;">Hentikan email notifikasi tim jaringan user</button>
    </form>
    @else
    <form method="POST" action="{{ route('user.notif.jaringan', ['user' => $user->id, 'notif' => 'true']) }}">
        @csrf
        <button type="submit" class="btn btn-danger" style="padding: 4px 8px;font-size: 11pt;">Email notifikasi tim jaringan user untuk permintaan baru</button>
    </form>
    @endif
    @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/form/bootstrap.min.js') }}" defer></script>
<script src="{{ asset('js/form/jquery.min.js') }}" defer></script>
<script src="{{ asset('js/fieldset.js') }}" defer></script>
@endsection
