@extends('layouts.header')

@section('content')
<div class="container-fluid">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{route('unit.baru')}}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="nama" class="col-md-4 col-form-label text-md-left">{{ __('Nama') }}</label>
            <i class="fa fa-user"></i>
            <div class="col-md-6">
                <input id="nama" type="text" name="nama" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="tipe" class="col-md-4 col-form-label text-md-left">{{ __('Tipe Unit') }}</label>
            <i class="fa fa-address-card"></i>
            <div class="col-md-6">
                <select id="tipeUnit" name="tipeUnit" class="form-control">
                    @foreach ($tipeUnits as $tipeUnit)
                    <option value="{{$tipeUnit->id}}">{{$tipeUnit->nama}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Baru</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/form/bootstrap.min.js') }}" defer></script>
<script src="{{ asset('js/form/jquery.min.js') }}" defer></script>
<script src="{{ asset('js/fieldset.js') }}" defer></script>
@endsection