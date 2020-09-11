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

    static function selectList()
    {
        return DomainAktif::join('users', 'users.id', '=', 'domain_aktifs.user_id')
            ->join('tipe_servers', 'tipe_servers.id', '=', 'domain_aktifs.tipe_server_id')
            ->join('units', 'units.id', '=', 'domain_aktifs.unit_id')
            ->select([
                'domain_aktifs.id',
                'users.nama as user_nama',
                'units.nama as unit_nama',
                'domain_aktifs.alias',
                'tipe_servers.nama_server',
                'domain_aktifs.kapasitas',
                'domain_aktifs.ip_domain',
                'domain_aktifs.aktif',
                'domain_aktifs.created_at',
            ]);
    }

    // Buat domain aktif dari sebuah sejarah
    static function simpanDariSejarah(SejarahDomain $per)
    {
        if (!$per->domain_aktif_id) {
        // Jika membuat domain baru
            $domain = new DomainAktif();
            $domain->alias = $per->nama_domain;
            $domain->user_id = $per->user_id;
        } else {
        // Jika memperbaharui sebuah domain
            $domain = DomainAktif::find($per->domain_aktif_id);
            $domain->alias = $domain->aliases();
        }

        $domain->fill([
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
