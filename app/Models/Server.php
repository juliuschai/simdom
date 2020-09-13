<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $guarded = [];

    static function selectList()
    {
        return Server::select([
            'id',
            'nama',
            'created_at',
            'lokasi_server',
        ]);
    }

    function perbaharuiDariRequest($req)
    {
        $this->fill([
            'nama' => $req->namaServer,
            'lokasi_server' => $req->lokasiServer,
            'keterangan' => $req->keterangan,
        ]);

        $this->save();
    }

    static function serverBaru($req)
    {
        $server = Server::create([
            'nama' => $req->namaServer,
            'lokasi_server' => $req->lokasiServer,
            'keterangan' => $req->keterangan,
        ]);

        return $server;
    }
}
