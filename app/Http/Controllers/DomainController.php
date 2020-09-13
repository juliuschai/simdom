<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermintaanRequest;
use App\Models\Domain;
use App\Models\Permintaan;
use App\Models\Server;
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
            $model = Domain::selectList()->newQuery();
        } else {
            $model = Domain::selectListUser()->newQuery();
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

        return view('domain.baru', compact('user', 'units', 'tipeUnits'));
    }

    function simpanBaru(PermintaanRequest $req)
    {
        $permintaan = Permintaan::permintaanBaru($req, null);

        return redirect()->route('permintaan.lihat', $permintaan->id);
    }

    function formEdit(Domain $domain)
    {
        $user = User::findOrLogout(auth()->id());
        $units = Unit::getSorted();
        $tipeUnits = TipeUnit::getSorted();
        $servers = Server::get(['id', 'nama as nama']);

        return view(
            'domain.edit',
            compact('user', 'units', 'tipeUnits', 'servers', 'domain')
        );
    }

    function simpanEdit(Domain $domain, PermintaanRequest $req)
    {
        if ($domain->aktif == 'menunggu') {
            return redirect()
                ->back()
                ->withErrors([
                    'Domain sedang dirubah, tunggu perubahan domain selesai' .
                    'dilakukan atau hapus permintaan perubahan jika permintaan belum diverifikasi',
                ]);
        }
        $req->ipAddress = $domain->ip;
        $domain->aktif = 'menunggu';
        $domain->save();

        $permintaan = Permintaan::permintaanBaru($req, $domain->id);
        return redirect()->route('permintaan.lihat', $permintaan->id);
    }

    function formTransfer(Domain $domain)
    {
        $pemilik = $domain->user;

        return view('domain.transfer', compact('pemilik'));
    }

    function saveTransfer(Domain $domain, Request $req)
    {
        $user = User::findOrFail($req->id);

        Permintaan::permintaanDariDomain(
            $domain,
            "Transfer kepemilikan domain dari {$domain->user->email} - {$domain->user->integra}" +
                " ke {$user->email} - {$user->integra}",
            true
        );

        $domain->user_id = $user->id;
        $domain->save();

        return redirect()->route('domain.list');
    }

    function nonaktifasi(Domain $domain)
    {
        Permintaan::permintaanDariDomain(
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
