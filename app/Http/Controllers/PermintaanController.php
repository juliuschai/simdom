<?php

namespace App\Http\Controllers;

use App\Models\DomainAktif;
use App\Models\SejarahDomain;
use App\User;
use Illuminate\Http\Request;

use DataTables;

class PermintaanController extends Controller
{
    function listData()
    {
        $user = User::findOrLogout(auth()->id());
        if ($user->isAdmin()) {
            $model = SejarahDomain::selectList()->newQuery();
        } else {
            $model = SejarahDomain::selectListUser()->newQuery();
        }

        return DataTables::eloquent($model)->toJson();
    }

    function list()
    {
        return view('permintaan.list');
    }

    function lihat(SejarahDomain $permintaan)
    {
        return view('permintaan.lihat', compact('permintaan'));
    }

    function hapus(SejarahDomain $permintaan)
    {
        if ($permintaan->status != 'menunggu') {
            abort('403', 'Permintaan yang sudah diproses tidak bisa dihapus!');
        }

        $this->tolak($permintaan);

        $permintaan->delete();

        return redirect()->route('permintaan.list'); // PART: change route to permintaan list
    }

    function terima(SejarahDomain $permintaan, Request $req)
    {
        $permintaan->status = 'diterima';
        $permintaan->ip_domain = $req->ipAddress;
        $permintaan->waktu_konfirmasi = now();
        $permintaan->waktu_selesai = null;
        $permintaan->save();

        return redirect()
            ->back()
            ->with('message', 'Permintan berhasil diterima');
    }

    function selesai(SejarahDomain $permintaan, Request $req)
    {
        $permintaan->status = 'selesai';
        $permintaan->ip_domain = $req->ipAddress;
        $permintaan->waktu_selesai = now();

        $domain = DomainAktif::simpanDariSejarah($permintaan);

        $permintaan->domain_aktif_id = $domain->id;
        $permintaan->save();

        return redirect()
            ->back()
            ->with('message', 'Permintan selesai');
    }

    function tolak(SejarahDomain $permintaan)
    {
        $permintaan->status = 'ditolak';
        $permintaan->waktu_konfirmasi = null;
        $permintaan->waktu_selesai = null;
        $permintaan->save();

        $domain = DomainAktif::find($permintaan->domain_aktif_id);
        $domain->aktif = 'aktif';
        $domain->save();

        return redirect()
            ->back()
            ->with('message', 'Permintan berhasil ditolak');
    }
}
