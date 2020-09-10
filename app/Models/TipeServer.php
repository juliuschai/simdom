<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipeServer extends Model
{
    protected $guarded = [];

    static function selectList()
    {
        return TipeServer::select([
            'id',
            'nama_server',
            'created_at',
            'lokasi_server',
        ]);
    }

    function perbaharuiDariRequest($req)
    {
        $this->fill([
            'nama_server' => $req->namaServer,
            'lokasi_server' => $req->lokasiServer,
            'keterangan' => $req->keterangan,
        ]);

        $this->save();
    }

    static function serverBaru($req)
    {
        $server = TipeServer::create([
            'nama_server' => $req->namaServer,
            'lokasi_server' => $req->lokasiServer,
            'keterangan' => $req->keterangan,
        ]);

        return $server;
    }
}
