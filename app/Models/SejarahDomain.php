<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SejarahDomain extends Model
{
    protected $guarded = [];

    /**
     * domain_aktif_id
     * nama_pj
     * nama_ins
     * no_telp
     * email
     * tgl_pengajuan
     * nama_domain
     * jenis_domain
     * status (menunggu,diterima,ditolak)
     */

    static function permintaanBaru($req, $domain_id)
    {
        if ($req->has('surat')) {
            $file = $req->file('surat');
            $filename = substr(
                date("hms") . '_' . $file->getClientOriginalName(),
                250
            );
            $file_path = $file->storeAs('surat', $filename, 'local');
        } else {
            $file_path = null;
        }

        $permintaan = SejarahDomain::create([
            'domain_aktif_id' => $domain_id,
            'user_id' => auth()->id(),
            'unit_id' => $req->unit,
            'surat' => $file_path,
            'nama_domain' => $req->namaDomain,
            'nama_panjang' => $req->namaPanjang,
            'tipe_server_id' => $req->tipeServer,
            'kapasitas' => $req->kapasitas,
            'keterangan' => $req->keterangan,
            'ip_domain' => $req->ipAddress,
        ]);

        return $permintaan;
    }

    function user()
    {
        return $this->belongsTo('App\User');
    }

    function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }

    function tipeServer()
    {
        return $this->belongsTo('App\Models\TipeServer');
    }

    function domainAktif()
    {
        return $this->belongsTo('App\Models\DomainAktif');
    }
}
