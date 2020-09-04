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
    <div id="viewBtnTemplate" style="display: none;">
        <a href="">
        <button style="padding: 3px 8px" type="button" class="btn btn-primary" title="Detail Domain">
            <i class="fa fa-search"></i>
        </button>
        </a>
    </div>
    <div id="editBtnTemplate" style="display: none;">
        <a href="">
        <button id="editBtn" style="padding: 3px 8px" type="button" class="btn btn-warning" title="Edit Domain">
            <i class="fa fa-pencil"></i>
        </button>
        </a> 
    </div>
    <div id="delBtnTemplate" style="display: none;">
        <form action="{{ route('domain.delete',['id'=>0]) }}" method="post" class="d-inline">    
            @csrf
            <button style="padding: 3px 8px;" type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus Domain?')" title="Hapus Domain">
                <i class="fa fa-trash-o"></i>
            </button>
        </form>
    </div>
    
	<table id="domainTable" 
        class="table table-bordered table-striped table-bordered table-hover dataTable"
		data-ajaxurl="{{ route('domain.data') }}" 
	>
		<thead class="thead-custom-blue">
			<tr>
				<th scope="col">Id</th>
				<th scope="col">Nama PJ</th>
				<th scope="col">Nama Instansi</th>
                <th scope="col">No Telepon</th>
                <th scope="col">Nama Domain</th>
                <th scope="col">Jenis Domain</th>
                <th scope="col">Kapasitas DB</th>
				<th scope="col">IP Domain</th>
                <th scope="col">Tanggal Rekap</th>
                <th scope="col">Aksi</th>
			</tr>
		</thead>
		<tbody></tbody>
        <!-- <tfoot>
			<tr>
				<th></th>
				<th><input type="text" placeholder="Search Nama"></th>
				<th><input type="text" placeholder="Search Nama"></th> -->
					<!-- <select id="searchTypeSelect">
						<option value="">Semua</option> -->
						<!-- The rest of the options are generated by js -->
					<!-- </select> -->
				<!-- </th>
				<th></th>
				<th></th>
			</tr>
		</tfoot> -->
	</table>
	</div>
@endsection

@section('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css" defer/>
<script src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js" defer></script>
<script src="{{asset('js/util/datatablesPlugin.js') }}" defer></script>
<script src="{{asset('js/domain/table.js') }}" defer></script>
@endsection