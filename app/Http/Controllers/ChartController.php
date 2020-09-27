<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Permintaan;
use App\Models\TipeUnit;
use App\Models\Unit;
use App\Models\Server;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function index()
    {
        // Jumlah Permintaan
        $perbulan = Permintaan::select(\DB::raw("SUM(MONTH(waktu_konfirmasi)) as bulan"))
            ->join('units', 'units.id', '=', 'permintaans.unit_id')
            ->groupBy(\DB::raw('units.nama'))
            ->orderByRaw('bulan DESC')
            ->limit(5)
            ->pluck('bulan');

        $nama_bulan = Permintaan::select(\DB::raw("SUM(MONTH(waktu_konfirmasi)) as bulan, MONTH(waktu_konfirmasi) as nama_bulan"))
            ->join('units', 'units.id', '=', 'permintaans.unit_id')
            ->groupBy(\DB::raw('units.nama'))
            ->orderByRaw('bulan DESC')
            ->limit(5)
            ->pluck('nama_bulan');

        $pertahun = Permintaan::select(\DB::raw("SUM(YEAR(waktu_konfirmasi)) as tahun"))
            ->join('units', 'units.id', '=', 'permintaans.unit_id')
            ->groupBy(\DB::raw('units.nama'))
            ->orderByRaw('tahun DESC')
            ->limit(5)
            ->pluck('tahun');

        $nama_tahun = Permintaan::select(\DB::raw("SUM(YEAR(waktu_konfirmasi)) as tahun, YEAR(waktu_konfirmasi) as nama_tahun"))
            ->join('units', 'units.id', '=', 'permintaans.unit_id')
            ->groupBy(\DB::raw('units.nama'))
            ->orderByRaw('tahun DESC')
            ->limit(5)
            ->pluck('nama_tahun');

        // unit
        $departements = Domain::select(\DB::raw("COUNT(*) as count"))
                    ->join('units', 'units.id', '=', 'domains.unit_id')
                    ->where('units.unit_type_id', '=', '1')
                    ->groupBy(\DB::raw('units.nama'))
                    ->orderByRaw('count DESC')
                    ->limit(5)
                    ->pluck('count');

        $nama_departemen = Domain::select(\DB::raw("COUNT(*) as count, units.nama"))
                    ->join('units', 'units.id', '=', 'domains.unit_id')
                    ->where('units.unit_type_id', '=', '1')
                    ->groupBy(\DB::raw('units.nama'))
                    ->orderByRaw('count DESC')
                    ->limit(5)
                    ->pluck('units.nama');
        
        $faculties = Domain::select(\DB::raw("COUNT(*) as count"))
                    ->join('units', 'units.id', '=', 'domains.unit_id')
                    ->where('units.unit_type_id', '=', '2')
                    ->groupBy(\DB::raw('units.nama'))
                    ->orderByRaw('units.nama DESC')
                    ->pluck('count');

        $nama_fakultas = Unit::select(\DB::raw("units.nama"))
                    ->where('units.unit_type_id', '=', '2')
                    ->orderByRaw('units.nama DESC')
                    ->pluck('units.nama');

        $units = Domain::select(\DB::raw("COUNT(*) as count"))
                    ->join('units', 'units.id', '=', 'domains.unit_id')
                    ->where('units.unit_type_id', '=', '3')
                    ->groupBy(\DB::raw('units.nama'))
                    ->orderByRaw('count DESC')
                    ->limit(5)
                    ->pluck('count');

        $nama_unit = Domain::select(\DB::raw("COUNT(*) as count, units.nama"))
                    ->join('units', 'units.id', '=', 'domains.unit_id')
                    ->where('units.unit_type_id', '=', '3')
                    ->groupBy(\DB::raw('units.nama'))
                    ->orderByRaw('count DESC')
                    ->limit(5)
                    ->pluck('units.nama');

        // server
        $servers = Domain::select(\DB::raw("COUNT(*) as count"))
            ->join('servers', 'servers.id', '=', 'domains.server_id')
            ->groupBy(\DB::raw('servers.nama'))
            ->orderByRaw('count DESC')
            ->pluck('count');

        $nama_server = Domain::select(\DB::raw("COUNT(*) as count, servers.nama"))
            ->join('servers', 'servers.id', '=', 'domains.server_id')
            ->groupBy(\DB::raw('servers.nama'))
            ->orderByRaw('count DESC')
            ->pluck('servers.nama');

        return view('chart.chart', compact('perbulan', 'nama_bulan', 'pertahun', 'nama_tahun',
                'departements', 'faculties', 'units', 'nama_departemen', 'nama_fakultas', 'nama_unit', 
                'servers', 'nama_server'));

    }
    
}