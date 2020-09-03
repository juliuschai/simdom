<?php

namespace App\Http\Controllers;

use App\Http\Requests\DomainBaruRequest;
use App\Models\DomainAktif;
use App\Models\SejarahDomain;
use App\Models\TipeServer;
use App\Models\TipeUnit;
use App\Models\Unit;
use App\User;
use App\Models\Domain;
use Illuminate\Http\Request;

use DataTables;

class DomainController extends Controller
{
    function setNonAktif()
    {
    }

    function formDomainBaru()
    {
        $user = User::findOrLogout(auth()->id());
        $units = Unit::getSorted();
        $tipeUnits = TipeUnit::getSorted();
        $servers = TipeServer::get(['id', 'nama_server as nama']);
        return view(
            'domain.baru',
            compact('user', 'units', 'tipeUnits', 'servers')
        );
    }

    function simpanDomainBaru(DomainBaruRequest $req)
    {
        $permintaan = SejarahDomain::permintaanDomainBaru($req);
        return redirect()->route('permintaan.lihat', $permintaan->id);
    }

    function editDomain(DomainAktif $domain, DomainBaruRequest $req) 
    {
        $domain->status = 'menunggu';
        $domain->save();
        // TODO: 
    }

    function listDomainData() {
        $model = Domain::viewDomainList()
            ->newQuery();

        return DataTables::eloquent($model)
            ->toJson();
    }

    function listDomain(Request $request) {
        $domains = Domain::viewDomainList()
            ->orderBy('id')
            ->paginate('10');

        $length = Domain::count();
        return view('domain.list', compact(['domains', 'length']));
    }

    function deleteDomain(Request $request)
    {
        $id = $request['id'];
        Domain::destroy($id);

        return redirect()->route('domain.list');
    }
}
