@extends('layouts.header')

@section('content')

<!-- <div class="right_col booking" role="main"> -->
<!-- <div class="container-fluid"> -->
<div class="col-md-12 col-sm-12">
	<h2 class="table-title">Data Domain</h2>
	@if(session()->has('message'))
	<div class="alert alert-success">
		{{ session()->get('message') }}
	</div>
	@endif

	<!-- Action button templates -->
	<div id="editBtnTemplate" style="display: none;">
		<a href="{{route('domain.edit', ['domain' => 0])}}">
			<button id="editBtn" style="padding: 3px 8px" type="button" class="btn btn-warning" title="Edit Domain">
				<i class="fa fa-pencil"></i>
			</button>
		</a>
	</div>

	<table id="tableElm" class="table table-bordered table-striped table-bordered table-hover dataTable"
		data-ajaxurl="{{ route('domain.data') }}">
		<thead class="thead-custom-blue">
			<tr>
				<th scope="col">Id</th>
				<th scope="col">Nama PJ</th>
				<th scope="col">Nama Instansi</th>
				<th scope="col">Nama Domain</th>
				<th scope="col">Jenis Domain</th>
				<th scope="col">Kapasitas DB</th>
				<th scope="col">IP Domain</th>
				<th scope="col">Status</th>
				<th scope="col">Tanggal Rekap</th>
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
<script src="{{asset('js/domain/list.js') }}" defer></script>
@endsection