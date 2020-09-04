<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DomainAktif extends Model
{
    protected $guarded = [];

    /**
     * nama_pj
     * nama_ins
     * no_telp
     * email
     * nama_domain
     * jenis_domain
     * status
     */

    static function viewDomainList()
    {
        return DomainAktif::join('users', '')->select([
            'id',
            'name_pj',
            'name_ins',
            'no_tlp',
            'name_domain',
            'jenis_domain',
            'kp_sekarang',
            'ip_domain',
            'tgl_input',
        ]);
    }

    // Buat domain aktif dari sebuah sejarah
    static function simpanDariSejarah(SejarahDomain $per)
    {
        // Jika membuat domain baru
        if (!$per->domain_aktif_id) {
            $domain = new DomainAktif();
            $domain->alias = $per->nama_domain;
        } else {
            // Jika memperbaharui sebuah domain
            $domain = DomainAktif::find($per->domain_aktif_id);
            $domain->alias = $domain->aliases();
        }

        $domain->fill([
            'user_id' => auth()->id(),
            'unit_id' => $per->unit_id,
            'ip_domain' => $per->ip_domain,
            'nama_domain' => $per->nama_domain,
            'nama_panjang' => $per->nama_panjang,
            'tipe_server_id' => $per->tipe_server_id,
            'kapasitas' => $per->kapasitas,
            'aktif' => 'aktif',
        ]);
        $domain->save();

        return $domain;
    }

    function aliases()
    {
        $arr = $this->sejarahDomains
            ->unique('nama_domain')
            ->map(function ($array) {
                return $array['nama_domain'];
            })
            ->all();
        return implode(',', $arr);
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

    function sejarahDomains()
    {
        return $this->hasMany(
            'App\Models\SejarahDomain',
            'domain_aktif_id',
            'id'
        );
    }
}
