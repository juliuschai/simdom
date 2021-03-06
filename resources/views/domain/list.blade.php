@extends('layouts.header')

@section('content')
<div class="right_col booking" role="main">
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

		@admin
		<div id="nonaktifasiBtnTemplate" style="display: none;">
			<form action="{{route('domain.nonaktifasi', ['domain' => 0])}}" method="POST" class="d-inline">
				@csrf
				<button type="submit" class="btn btn-danger" style="padding: 3px 8px" onclick="
				return confirm('Domain akan dinonaktifkan! Lanjutkan?')" title="Nonaktif Server"><i class="fa fa-power-off"></i></button>
			</form>
		</div>

		<div id="aktifasiBtnTemplate" style="display: none;">
			<form action="{{route('domain.aktifasi', ['domain' => 0])}}" method="POST" class="d-inline">
				@csrf
				<button type="submit" class="btn btn-success" style="padding: 3px 8px" onclick="
				return confirm('Aktifasi domain?')" title="Aktifasi Domain"><i class="fa fa-power-off"></i></button>
			</form>
		</div>

		<div id="nonformalBtnTemplate" style="display: none;">
			<form action="{{route('domain.nonformal', ['domain' => 0])}}" method="POST" class="d-inline">
				@csrf
				<button type="submit" class="btn btn-danger" style="padding: 3px 8px" onclick="
				return confirm('Tandai domain sebagai formal?')" title="Tandai Formal"><i class="fa fa-briefcase"></i></button>
			</form>
		</div>

		<div id="formalBtnTemplate" style="display: none;">
			<form action="{{route('domain.formal', ['domain' => 0])}}" method="POST" class="d-inline">
				@csrf
				<button type="submit" class="btn btn-success" style="padding: 3px 8px" onclick="
				return confirm('Cabut tanda formal domain?')" title="Tandai Non-formal"><i class="fa fa-briefcase"></i></button>
			</form>
		</div>

        @else
		<div id="nonaktifasiBtnTemplate" style="display: none;">
			<a href=""></a>
		</div>

		<div id="aktifasiBtnTemplate" style="display: none;">
			<a href=""></a>
		</div>

        <div id="nonformalBtnTemplate" style="display: none;">
			<a href=""></a>
		</div>

		<div id="formalBtnTemplate" style="display: none;">
			<a href=""></a>
		</div>
		@endadmin

		<table id="tableElm" class="table table-bordered table-striped table-bordered table-hover dataTable"
			data-ajaxurl="{{ route('domain.data') }}">
			<thead class="thead-custom-blue">
				<tr>
					<th scope="col">Id</th>
					<th scope="col">Nama PIC</th>
					<th scope="col">Instansi</th>
					<th scope="col">Domain</th>
					<th scope="col">Jenis Domain</th>
					<th scope="col">Kapasitas DB</th>
					<th scope="col">IP</th>
					<th scope="col">Status</th>
					<th scope="col">Aktif</th>
					<th scope="col">Formal</th>
					<th scope="col">Dibuat</th>
					<th scope="col">Aksi</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css" defer />
<script src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js" defer></script>
<script src="{{asset('js/util/datatablesPlugin.js') }}" defer></script>
<script src="{{asset('js/domain/list.js') }}" defer></script>
@endsection
