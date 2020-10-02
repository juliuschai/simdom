@extends('layouts.header')

@section('content')

<div class="right_col booking" role="main">
	<div class="col-md-12 col-sm-12">
		<h2 class="table-title">Data Server</h2>
		@if(session()->has('message'))
		<div class="alert alert-success">
			{{ session()->get('message') }}
		</div>
		@endif

		<div id="editBtnTemplate" style="display: none;">
			<a href="{{route('server.edit', ['server' => 0])}}">
				<button id="editBtn" style="padding: 3px 8px" type="button" class="btn btn-warning" title="Edit Server">
					<i class="fa fa-pencil"></i>
				</button>
			</a>
		</div>

		<div id="delBtnTemplate" style="display: none;">
			<form action="{{route('server.hapus', ['server' => 0])}}" method="POST" class="d-inline">
				@csrf
				<button type="submit" class="btn btn-danger" style="padding: 3px 8px" onclick="
				return confirm('Anda yakin menghapus server?')" title="Hapus Server"><i class="fa fa-trash-o"></i></button>
			</form>
		</div>

	<table id="tableElm" class="table table-bordered table-striped table-bordered table-hover dataTable"
		data-ajaxurl="{{ route('server.data') }}">
		<thead class="thead-custom-blue">
			<tr>
				<th scope="col">Id</th>
				<th scope="col">Nama PIC</th>
				<th scope="col">Email PIC</th>
				<th scope="col">No. HP PIC</th>
				<th scope="col">Unit</th>
				<th scope="col">Deskripsi</th>
				<th scope="col">No. Rack</th>
				<th scope="col">Dibuat</th>
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
<script src="{{asset('js/server/list.js') }}" defer></script>
@endsection