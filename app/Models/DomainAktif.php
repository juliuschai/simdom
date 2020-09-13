<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
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
        return Domain::join('users', 'users.id', '=', 'domains.user_id')
            ->join('servers', 'servers.id', '=', 'domains.server_id')
            ->join('units', 'units.id', '=', 'domains.unit_id')
            ->select([
                'domains.id',
                'users.nama as user_nama',
                'units.nama as unit_nama',
                'domains.alias',
                'servers.nama as nama_server',
                'domains.kapasitas',
                'domains.ip',
                'domains.aktif',
                'domains.created_at',
            ]);
    }

    static function selectListUser()
    {
        return Domain::selectList()->where('user_id', auth()->id());
    }

    // Buat domain aktif dari sebuah sejarah
    static function simpanDariSejarah(Permintaan $per)
    {
        if (!$per->domain_id) {
        // Jika membuat domain baru
            $domain = new Domain();
            $domain->alias = $per->nama_domain;
            $domain->user_id = $per->user_id;
        } else {
        // Jika memperbaharui sebuah domain
            $domain = Domain::find($per->domain_id);
            $domain->alias = $domain->aliases();
        }

        $domain->fill([
            'unit_id' => $per->unit_id,
            'ip' => $per->ip,
            'nama_domain' => $per->nama_domain,
            'deskripsi' => $per->deskripsi,
            'server_id' => $per->server_id,
            'kapasitas' => $per->kapasitas,
            'aktif' => 'aktif',
        ]);
        $domain->save();

        return $domain;
    }

    function aliases()
    {
        $arr = $this->permintaans
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

    function server()
    {
        return $this->belongsTo('App\Models\Server');
    }

    function permintaans()
    {
        return $this->hasMany(
            'App\Models\Permintaan',
            'domain_id',
            'id'
        );
    }
}
