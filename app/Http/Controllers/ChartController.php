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
        $perbulan = Permintaan::select(\DB::raw("CONVERT(SUM(MONTH(waktu_konfirmasi)), SIGNED) as bulan, MONTH(waktu_konfirmasi) as nama_bulan"))
            ->groupBy(\DB::raw("MONTH(waktu_konfirmasi)"))
            ->orderByRaw('nama_bulan ASC')
            ->pluck('bulan');

        $nama_bulan = Permintaan::select(\DB::raw("CONVERT(SUM(MONTH(waktu_konfirmasi)), SIGNED) as bulan, MONTH(waktu_konfirmasi) as nama_bulan"))
            ->groupBy(\DB::raw("MONTH(waktu_konfirmasi)"))
            ->orderByRaw('nama_bulan ASC')
            ->pluck('nama_bulan');

        $pertahun = Permintaan::select(\DB::raw("CONVERT(SUM(YEAR(waktu_konfirmasi)), SIGNED) as tahun, YEAR(waktu_konfirmasi) as nama_tahun"))
            ->groupBy(\DB::raw("YEAR(waktu_konfirmasi)"))
            ->orderByRaw('nama_tahun ASC')
            ->pluck('tahun');

        $nama_tahun = Permintaan::select(\DB::raw("CONVERT(SUM(YEAR(waktu_konfirmasi)), SIGNED) as tahun, YEAR(waktu_konfirmasi) as nama_tahun"))
            ->groupBy(\DB::raw("YEAR(waktu_konfirmasi)"))
            ->orderByRaw('nama_tahun ASC')
            ->pluck('nama_tahun');

        // unit
        $departements = Domain::select(\DB::raw("COUNT(*) as count"))
                    ->join('units', 'units.id', '=', 'domains.unit_id')
                    ->where('units.tipe_unit_id', '=', '1')
                    ->groupBy(\DB::raw('units.nama'))
                    ->orderByRaw('count DESC')
                    ->limit(5)
                    ->pluck('count');

        $nama_departemen = Domain::select(\DB::raw("COUNT(*) as count, units.nama"))
                    ->join('units', 'units.id', '=', 'domains.unit_id')
                    ->where('units.tipe_unit_id', '=', '1')
                    ->groupBy(\DB::raw('units.nama'))
                    ->orderByRaw('count DESC')
                    ->limit(5)
                    ->pluck('units.nama');
        
        $faculties = Domain::select(\DB::raw("COUNT(*) as count"))
                    ->join('units', 'units.id', '=', 'domains.unit_id')
                    ->where('units.tipe_unit_id', '=', '2')
                    ->groupBy(\DB::raw('units.nama'))
                    ->orderByRaw('units.nama DESC')
                    ->pluck('count');

        $nama_fakultas = Unit::select(\DB::raw("units.nama"))
                    ->where('units.tipe_unit_id', '=', '2')
                    ->orderByRaw('units.nama DESC')
                    ->pluck('units.nama');

        $units = Domain::select(\DB::raw("COUNT(*) as count"))
                    ->join('units', 'units.id', '=', 'domains.unit_id')
                    ->where('units.tipe_unit_id', '=', '3')
                    ->groupBy(\DB::raw('units.nama'))
                    ->orderByRaw('count DESC')
                    ->limit(5)
                    ->pluck('count');

        $nama_unit = Domain::select(\DB::raw("COUNT(*) as count, units.nama"))
                    ->join('units', 'units.id', '=', 'domains.unit_id')
                    ->where('units.tipe_unit_id', '=', '3')
                    ->groupBy(\DB::raw('units.nama'))
                    ->orderByRaw('count DESC')
                    ->limit(5)
                    ->pluck('units.nama');

        // server
        $servers_WHS = Domain::select(\DB::raw("COUNT(*) as count"))
            ->where('domains.server', '=', 'WHS')
            ->orderByRaw('count DESC')
            ->pluck('count');

        $servers_VPS = Domain::select(\DB::raw("COUNT(*) as count"))
            ->where('domains.server', '=', 'VPS')
            ->orderByRaw('count DESC')
            ->pluck('count');

        $servers_Colocation = Domain::select(\DB::raw("COUNT(*) as count"))
            ->where('domains.server', '=', 'Colocation')
            ->orderByRaw('count DESC')
            ->pluck('count');

        return view('chart.chart', compact('perbulan', 'nama_bulan', 'pertahun', 'nama_tahun',
                'departements', 'faculties', 'units', 'nama_departemen', 'nama_fakultas', 'nama_unit', 
                'servers_WHS', 'servers_VPS', 'servers_Colocation'));

    }
    
}