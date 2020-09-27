
@extends('layouts.header')

@section('content')
<div class="right_col booking" role="main">
  <div class="col-md-12 col-sm-12">
    <div class="row">
        <canvas id="perbulan" class="card" width="761" height="280" style="margin: 3px; padding: 20px;" class="chart"></canvas>
        <canvas id="pertahun" class="card" width="761" height="280" style="margin: 3px; padding: 20px;" class="chart"></canvas>
    </div>
    <div class="row">
        <canvas id="departemen" class="card" width="761" height="280" style="margin: 3px; padding: 20px;" class="chart"></canvas>
        <canvas id="fakultas" class="card" width="761" height="280" style="margin: 3px; padding: 20px;" class="chart"></canvas>
    </div>
    <div class="row">
        <canvas id="unit" class="card" width="761" height="280" style="margin: 3px; padding: 20px;" class="chart"></canvas>
        <canvas id="server" class="card" width="761" height="280" style="margin: 3px; padding: 20px;" class="chart"></canvas>
    </div>
  </div>
</div>

<input type="hidden" id="serverData" 
  data-perbulan="{{json_encode($perbulan)}}"
  data-nama_bulan="{{json_encode($nama_bulan)}}"
  
  data-pertahun="{{json_encode($pertahun)}}"
  data-nama_tahun="{{json_encode($nama_tahun)}}"

  data-departements="{{json_encode($departements)}}"
  data-nama_departemen="{{json_encode($nama_departemen)}}"
  
  data-faculties="{{json_encode($faculties)}}"
  data-nama_fakultas="{{json_encode($nama_fakultas)}}"

  data-units="{{json_encode($units)}}"
  data-nama_unit="{{json_encode($nama_unit)}}"

  data-departements="{{json_encode($departements)}}"
  data-nama_departemen="{{json_encode($nama_departemen)}}"

  data-server="{{json_encode($servers)}}"
  data-nama_server="{{json_encode($nama_server)}}"
>

@endsection

@section('scripts')
<script src="{{ asset('js/chart/chart.js')}}" defer></script>
<script src="{{ asset('js/chart/chartjs-plugin-colorschemes.min.js')}}" defer></script>
<script src="{{ asset('js/chart/chart-view.js')}}" defer></script>
@endsection
