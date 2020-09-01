<?php

namespace App\Http\Controllers;

use App\Http\Requests\DomainBaruRequest;
use App\Models\DomainAktif;
use App\Models\SejarahDomain;
use App\Models\TipeUnit;
use App\Models\Unit;
use App\TipeServer;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    function setNonAktif()
    {
        
    }

    function formDomainBaru()
    {
        $user = User::findOrLogout(auth()->id());
        $units = Unit::get();
        $tipeUnits = TipeUnit::get();
        $servers = TipeServer::get(['id', 'nama_server as nama']);
        return view('domain.baru', compact('user', 'units', 'tipeUnits', 'servers'));
    }

    function simpanDomainBaru(DomainBaruRequest $req)
    {
        dd($req->all());
        SejarahDomain::permintaanDomainBaru($req);
        // return view('domain.table', ['message' => 'Domain berhasil dibuat']);
    }
}
