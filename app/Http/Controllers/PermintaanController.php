<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Permintaan;
use App\User;
use Illuminate\Http\Request;

use DataTables;

class PermintaanController extends Controller
{
    function listData()
    {
        $user = User::findOrLogout(auth()->id());
        if ($user->isAdmin()) {
            $model = Permintaan::selectList()->newQuery();
        } else {
            $model = Permintaan::selectListUser()->newQuery();
        }

        return DataTables::eloquent($model)->toJson();
    }

    function list()
    {
        return view('permintaan.list');
    }

    function lihat(Permintaan $permintaan)
    {
        return view('permintaan.lihat', compact('permintaan'));
    }

    function hapus(Permintaan $permintaan)
    {
        if ($permintaan->status != 'menunggu') {
            abort('403', 'Permintaan yang sudah diproses tidak bisa dihapus!');
        }

        $this->tolak($permintaan);

        $permintaan->delete();

        return redirect()->route('permintaan.list'); // PART: change route to permintaan list
    }

    function terima(Permintaan $permintaan, Request $req)
    {
        $permintaan->status = 'diterima';
        $permintaan->ip = $req->ipAddress;
        $permintaan->waktu_konfirmasi = now();
        $permintaan->waktu_selesai = null;
        $permintaan->save();

        return redirect()
            ->back()
            ->with('message', 'Permintan berhasil diterima');
    }

    function selesai(Permintaan $permintaan, Request $req)
    {
        $permintaan->status = 'selesai';
        $permintaan->ip = $req->ipAddress;
        $permintaan->waktu_selesai = now();

        $domain = Domain::simpanDariSejarah($permintaan);

        $permintaan->domain_id = $domain->id;
        $permintaan->save();

        return redirect()
            ->back()
            ->with('message', 'Permintan selesai');
    }

    function tolak(Permintaan $permintaan)
    {
        $permintaan->status = 'ditolak';
        $permintaan->waktu_konfirmasi = null;
        $permintaan->waktu_selesai = null;
        $permintaan->save();

        $domain = Domain::find($permintaan->domain_id);
        $domain->aktif = 'aktif';
        $domain->save();

        return redirect()
            ->back()
            ->with('message', 'Permintan berhasil ditolak');
    }
}
