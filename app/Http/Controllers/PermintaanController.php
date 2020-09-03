<?php

namespace App\Http\Controllers;

use App\Models\DomainAktif;
use App\Models\SejarahDomain;
use App\User;
use Illuminate\Http\Request;

class PermintaanController extends Controller
{
    function lihatPermintaan(SejarahDomain $permintaan)
    {
        return view('permintaan.lihat', compact('permintaan'));
    }

    function terimaPermintaan(SejarahDomain $permintaan, Request $req)
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

    function selesaiPermintaan(SejarahDomain $permintaan, Request $req)
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

    function tolakPermintaan(SejarahDomain $permintaan)
    {
        $permintaan->status = 'ditolak';
        $permintaan->waktu_konfirmasi = null;
        $permintaan->waktu_selesai = null;
        $permintaan->save();

        return redirect()
            ->back()
            ->with('message', 'Permintan berhasil ditolak');
    }
}
