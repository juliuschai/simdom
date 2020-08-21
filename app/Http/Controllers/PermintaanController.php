<?php

namespace App\Http\Controllers;

use App\Models\DomainAktif;
use App\Models\SejarahDomain;
use App\Models\TipeUnit;
use App\Models\Unit;
use Illuminate\Http\Request;

class PermintaanController extends Controller
{
    function lihatPermintaanBaru()
    {
        $units = Unit::get();
        $tipeUnits = TipeUnit::get();
        return view('domain.daftar', compact('units', 'tipeUnits'));
    }

    function simpanPermintaanBaru()
    {
        // SejarahDomain::save();
    }

    function viewDomain($id)
    {
    }

    function terimaPermintaanDomain($id)
    {
    }

    function tolakPermintaanDomain($id)
    {

        DomainAktif::simpanDariSejarah(SejarahDomain::find($id));
    }
}
