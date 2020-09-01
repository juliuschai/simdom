<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DomainAktif extends Model
{
    /**
     * nama_pj
     * nama_ins
     * no_telp
     * email
     * nama_domain
     * jenis_domain
     * status
     */

    function aliases()
    {
        $this->sejarah_domains->map(function ($array) {
            return collect($array)->unique('nama_domain')->all();
        });
    }

    function sejarah_domains()
    {
        return $this->hasMany('App\Models\SejarahDomain', 'domain_aktif_id', 'id');
    }
}
