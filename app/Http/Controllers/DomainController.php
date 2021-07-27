<?php

namespace App\Http\Controllers;

use App\Helpers\EmailHelper;
use App\Http\Requests\ExportNoOptRequest;
use App\Http\Requests\PermintaanRequest;
use App\Models\Domain;
use App\Models\Permintaan;
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

        $units = Unit::getDropdownOptions(false);
        $tipeUnits = TipeUnit::getDropdownOptions(false);

        $keperuntukans = Unit::getDropdownOptions(true);
        $tipeKeperuntukans = TipeUnit::getDropdownOptions(true);

        return view(
            'domain.baru',
            compact(
                'user',
                'units',
                'tipeUnits',
                'keperuntukans',
                'tipeKeperuntukans'
            )
        );
    }

    function simpanBaru(PermintaanRequest $req)
    {
        $permintaan = Permintaan::permintaanBaru($req);

        return redirect()
            ->route('permintaan.lihat', $permintaan->id)
            ->with('message', 'Permintaan buat domain berhasil!');
    }

    function view(Domain $domain)
    {
        $user = User::findOrFail($domain->user_id);

        return view('domain.view', compact('user', 'domain'));
    }

    function formEdit(Domain $domain)
    {
        $user = User::findOrLogout(auth()->id());

        $units = Unit::getDropdownOptions(false);
        $tipeUnits = TipeUnit::getDropdownOptions(false);

        $keperuntukans = Unit::getDropdownOptions(true);
        $tipeKeperuntukans = TipeUnit::getDropdownOptions(true);

        return view(
            'domain.edit',
            compact(
                'user',
                'units',
                'tipeUnits',
                'keperuntukans',
                'tipeKeperuntukans',
                'domain'
            )
        );
    }

    function simpanEdit(Domain $domain, PermintaanRequest $req)
    {
        if ($domain->status == 'menunggu') {
            return redirect()
                ->back()
                ->withErrors([
                    'Domain sedang dirubah, tunggu perubahan domain selesai ' .
                    'dilakukan atau hapus permintaan perubahan jika permintaan belum diverifikasi',
                ]);
        }

        $req->ip = $domain->ip;
        $req->namaDomain = $domain->nama_domain;
        $domain->status = 'menunggu';
        $domain->save();

        $permintaan = Permintaan::permintaanBaru($req, $domain->id);

        return redirect()
            ->route('permintaan.lihat', $permintaan->id)
            ->with('message', 'Permintaan edit domain berhasil!');
    }

    function formTransfer(Domain $domain)
    {
        $pemilik = $domain->user;

        return view('transfer', compact('pemilik'));
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

        EmailHelper::notifyTransfer(
            $domain->user->email,
            $user->email,
            $domain
        );

        return redirect()->route('domain.list');
    }

    function nonaktifasi(Domain $domain)
    {
        $permintaan = Permintaan::permintaanDariDomain(
            $domain,
            'Set domain menjadi nonaktif',
            true
        );

        $domain->aktif = 'nonaktif';
        $domain->save();

        EmailHelper::notifyStatus($permintaan, 'Domain berhasil dinonaktifkan');

        return redirect()
            ->back()
            ->with('message', 'Status Domain: nonaktif');
    }

    function aktifasi(Domain $domain)
    {
        $permintaan = Permintaan::permintaanDariDomain(
            $domain,
            'Set domain menjadi aktif',
            true
        );

        $domain->aktif = 'aktif';
        $domain->save();

        EmailHelper::notifyStatus($permintaan, 'Domain berhasil diaktifkan');

        return redirect()
            ->back()
            ->with('message', 'Status Domain: aktif');
    }

    function nonformal(Domain $domain)
    {
        $permintaan = Permintaan::permintaanDariDomain(
            $domain,
            'Set domain menjadi nonformal',
            true
        );

        $domain->formal = 'nonformal';
        $domain->save();

        return redirect()
            ->back()
            ->with('message', 'Status Domain: nonformal');
    }

    function formal(Domain $domain)
    {
        $permintaan = Permintaan::permintaanDariDomain(
            $domain,
            'Set domain menjadi formal',
            true
        );

        $domain->formal = 'formal';
        $domain->save();

        return redirect()
            ->back()
            ->with('message', 'Status Domain: formal');
    }

    function extend(Domain $domain)
    {
        $domain->extend();

        return redirect()
            ->route('domain.edit', $domain->id)
            ->with('message', 'Domain: extended');
    }

    function formExport()
    {
        return view('domain.export');
    }

    function downloadExport(Request $req)
    {
        return Domain::export($req);
    }
}
