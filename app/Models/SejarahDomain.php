<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SejarahDomain extends Model
{
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
    function domain_aktif()
    {
        return $this->belongsTo('App\Models\DomainAktif', 'domain_aktif_id', 'id');
    }
}
