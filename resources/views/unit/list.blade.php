@extends('layouts.header')

@section('content')

<div class="col-md-12 col-sm-12">
    <h2 class="table-title">Daftar Unit</h2>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif

    <a href="{{route('unit.baru')}}">
        <button type="button" class="btn btn-primary">Unit Baru</button>
    </a>
    <!-- Edit button template -->
    <div id="editBtnTemplate" style="display: none;">
        <a href="{{route('unit.edit', ['unit' => 0])}}">
            <button style="padding: 3px 8px; font-size: 11pt;" class="btn btn-warning">
                <i class="fa fa-pencil-square-o"></i> Edit
            </button>
        </a>
    </div>

    <table id="tableElm" class="table table-bordered table-striped table-bordered table-hover dataTable"
        data-ajaxurl="{{route('unit.data')}}">
        <thead class="thead-custom-blue">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nama</th>
                <th scope="col">Tipe</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

@endsection

@section('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css" defer />
<script src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js" defer></script>
<script src="{{asset('js/util/datatablesPlugin.js') }}" defer></script>
<script src="{{asset('js/unit/list.js') }}" defer></script>
@endsection