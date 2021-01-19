<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PantauWebController extends Controller
{
    // HMAC identification method
    public function index(Request $request)
    {
        // dd($request->identifier);
        // http://simdomdev.its.ac.id/pantauweb?identifier=EK8q2Yly&secret=3ui22cdqVCfVKY9C
        if (
            $request->identifier != env("PANTAI_WEB_IDENTIFIER") ||
            $request->secret != env("PANTAI_WEB_SECRET")
        ) {
            abort(404);
        }

        $result = Domain::select(
            "domains.id as id_data",
            "units.nama as name_ins",
            "domains.nama_domain as name_domain",
            "tipe_units.nama as jenis_domain",
            DB::raw("SUBSTRING(`created_at`, 1, 10) as tgl_dibuatkan")
        )
            ->join("units", "units.id", "=", "domains.unit_id")
            ->join("tipe_units", "tipe_units.id", "=", "units.tipe_unit_id")
            ->where("aktif", "aktif")
            ->get();

        // $result = ['lorem' => 'ipsum'];
        return response()->json($result);
    }
}
