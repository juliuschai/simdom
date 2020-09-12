<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermintaanRequest;
use App\Models\DomainAktif;
use App\Models\SejarahDomain;
use App\Models\TipeServer;
use App\Models\TipeUnit;
use App\Models\Unit;
use App\User;
use Illuminate\Http\Request;

use DataTables;

class DomainController extends Controller
{
    function listData()
    {
        $user = User::findOrLogout(auth()->id());
        if ($user->isAdmin()) {
            $model = DomainAktif::selectList()->newQuery();
        } else {
            $model = DomainAktif::selectListUser()->newQuery();
        }
        return DataTables::eloquent($model)->toJson();
    }

    function list(Request $request)
    {
        return view('domain.list');
    }

    function formBaru()
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

    function simpanBaru(PermintaanRequest $req)
    {
        $permintaan = SejarahDomain::permintaanBaru($req, null);

        return redirect()->route('permintaan.lihat', $permintaan->id);
    }

    function formEdit(DomainAktif $domain)
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

    function saveEdit(DomainAktif $domain, PermintaanRequest $req)
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

    function formTransfer(DomainAktif $domain)
    {
        $pemilik = $domain->user;

        return view('domain.transfer', compact('pemilik'));
    }

    function saveTransfer(DomainAktif $domain, Request $req)
    {
        $user = User::findOrFail($req->id);

        SejarahDomain::permintaanDariDomain(
            $domain,
            "Transfer kepemilikan domain dari {$domain->user->email} - {$domain->user->integra}" +
                " ke {$user->email} - {$user->integra}",
            true
        );

        $domain->user_id = $user->id;
        $domain->save();

        return redirect()->route('domain.list');
    }

    function nonaktifasi(DomainAktif $domain)
    {
        SejarahDomain::permintaanDariDomain(
            $domain,
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
