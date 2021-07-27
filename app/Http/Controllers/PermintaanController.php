<?php

namespace App\Http\Controllers;

use App\Helpers\EmailHelper;
use App\Http\Requests\ExportRequest;
use App\Http\Requests\PermintaanSelesaiRequest;
use App\Http\Requests\PermintaanPeriksaRequest;
use App\Http\Requests\PermintaanTerimaRequest;
use App\Models\Domain;
use App\Models\Permintaan;
use App\Models\TipeUnit;
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
        $domain_templates = TipeUnit::getDomainTemplateOptions();

        return view(
            'permintaan.lihat',
            compact('permintaan', 'domain_templates')
        );
    }

    function lihatData()
    {
        $model = Domain::selectLihatData()->newQuery();

        return DataTables::eloquent($model)->toJson();
    }

    function hapus(Permintaan $permintaan)
    {
        if ($permintaan->status != 'menunggu') {
            abort('403', 'Permintaan yang sudah diproses tidak bisa dihapus!');
        }

        $this->tolak($permintaan);

        EmailHelper::notifyStatus($permintaan, 'Permintaan telah dihapus');

        $permintaan->delete();

        return redirect()->route('permintaan.list');
    }

    function terima(Permintaan $permintaan, PermintaanTerimaRequest $req)
    {
        $permintaan->fill([
            'nama_domain' => $req->namaDomain,
            'ip' => $req->ip,
            'status' => 'diterima',
            'waktu_konfirmasi' => now(),
            'waktu_selesai' => null,
        ]);
        $permintaan->save();

        EmailHelper::notifyStatus($permintaan, 'Permintaan sedang diproses');

        return redirect()
            ->back()
            ->with('message', 'Permintan berhasil diterima');
    }

    function periksa(Permintaan $permintaan, PermintaanPeriksaRequest $req)
    {
        $permintaan->fill([
            'nama_domain' => $req->namaDomain,
            'ip' => $req->ip,
            'status' => 'diperiksa'
        ]);
        $permintaan->save();

        EmailHelper::notifyStatus($permintaan, 'Permintaan sedang diperiksa');

        return redirect()
            ->back()
            ->with('message', 'Permintan berhasil selesai diproses');
    }

    function selesai(Permintaan $permintaan, PermintaanSelesaiRequest $req)
    {
        $permintaan->fill([
            'nama_domain' => $req->namaDomain,
            'status' => 'selesai',
            'ip' => $req->ip,
            'waktu_selesai' => now(),
        ]);

        $domain = Domain::simpanDariPermintaan($permintaan);

        $permintaan->domain_id = $domain->id;
        $permintaan->save();

        EmailHelper::notifyStatus($permintaan, 'Permintaan sudah selesai');

        return redirect()
            ->back()
            ->with('message', 'Permintan selesai');
    }

    function tolak(Permintaan $permintaan)
    {
        $permintaan->fill([
            'status' => 'ditolak',
            'waktu_konfirmasi' => null,
            'waktu_selesai' => null,
        ]);
        $permintaan->save();

        $domain = Domain::find($permintaan->domain_id);
        if ($domain) {
            $domain->status = 'siap';
            $domain->save();
            EmailHelper::notifyStatus($permintaan, 'Permintaan telah ditolak!');
        }

        return redirect()
            ->back()
            ->with('message', 'Permintan berhasil ditolak');
    }

    function formExport() {
        return view('permintaan.export');
    }

    function  downloadExport(ExportRequest $req) {
        return Permintaan::export($req);
    }
}
