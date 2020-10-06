
@extends('layouts.header')

@section('content')
<div class="right_col booking" role="main">
  <div class="col-md-12 col-sm-12">
    <div class="row">
      <div class="d-inline-flex" style="position: relative; height:19vh; width:38vw">
          <canvas id="perbulan" class="card" style="margin: 3px; padding: 20px;" class="chart">Jumlah Permintaan (perbulan)</canvas>
      </div>
      <div class="d-inline-flex" style="position: relative; height:19vh; width:38vw">
          <canvas id="pertahun" class="card" style="margin: 3px; padding: 20px;" class="chart">Jumlah Permintaan (pertahun)</canvas>
      </div>
    </div>
    <!-- <div class="row">
      <div class="d-inline-flex" style="position: relative; height:19vh; width:38vw">
          <canvas id="departemen" class="card" style="margin: 3px; padding: 20px;" class="chart"></canvas>
      </div>
      <div class="d-inline-flex" style="position: relative; height:19vh; width:38vw">
          <canvas id="fakultas" class="card" style="margin: 3px; padding: 20px;" class="chart"></canvas>
      </div>
    </div>
    <div class="row">
      <div class="d-inline-flex" style="position: relative; height:19vh; width:38vw">
          <canvas id="unit" class="card" style="margin: 3px; padding: 20px;" class="chart"></canvas>
      </div>
      <div class="d-inline-flex" style="position: relative; height:19vh; width:38vw">
          <canvas id="server" class="card" style="margin: 3px; padding: 20px;" class="chart"></canvas>
      </div>
    </div> -->
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

  data-server-WHS="{{json_encode($servers_WHS)}}"
  data-server-VPS="{{json_encode($servers_VPS)}}"
  data-server-Colocation="{{json_encode($servers_Colocation)}}"
>

@endsection

@section('scripts')
<script src="{{ asset('js/chart/chart.js')}}" defer></script>
<script src="{{ asset('js/chart/chartjs-plugin-colorschemes.min.js')}}" defer></script>
<script src="{{ asset('js/chart/chart-view.js')}}" defer></script>
@endsection
