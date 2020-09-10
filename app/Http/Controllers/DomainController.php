<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermintaanRequest;
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
    function listData()
    {
        $model = DomainAktif::selectList()->newQuery();

        return DataTables::eloquent($model)->toJson();
    }

    function list(Request $request)
    {
        return view('domain.list');
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

    function simpanDomainBaru(PermintaanRequest $req)
    {
        $permintaan = SejarahDomain::permintaanBaru($req, null);
        return redirect()->route('permintaan.lihat', $permintaan->id);
    }

    function formEditDomain(DomainAktif $domain)
    {
        $user = User::findOrLogout(auth()->id());
        $units = Unit::getSorted();
        $tipeUnits = TipeUnit::getSorted();
        $servers = TipeServer::get(['id', 'nama_server as nama']);

        return view(
            'domain.edit',
            compact('user', 'units', 'tipeUnits', 'servers', 'domain')
        );
    }

    function saveEditDomain(DomainAktif $domain, PermintaanRequest $req)
    {
        if ($domain->aktif == 'menunggu') {
            return redirect()
                ->back()
                ->withErrors([
                    'Domain sedang dirubah, tunggu perubahan domain selesai' .
                    'dilakukan atau hapus permintaan perubahan jika permintaan belum diverifikasi',
                ]);
        }
        $req->ipAddress = $domain->ip_domain;
        $domain->aktif = 'menunggu';
        $domain->save();

        $permintaan = SejarahDomain::permintaanBaru($req, $domain->id);
        return redirect()->route('permintaan.lihat', $permintaan->id);
    }

    function nonaktifasiDomain(DomainAktif $domain)
    {
        SejarahDomain::customPermintaan(
            $domain,
            auth()->id(),
            'Set domain menjadi nonaktif',
            true
        );

        $domain->aktif = 'nonaktif';
        $domain->save();

        return redirect()
            ->back()
            ->with('message', 'Status Domain: nonaktif');
    }
}
