<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Server extends Model
{
    protected $guarded = [];

    static function selectList()
    {
        return Server::join('users', 'users.id', '=', 'servers.user_id')
            ->join('units', 'units.id', '=', 'servers.unit_id')
            ->select([
                'servers.id',
                'users.nama as nama_user',
                'users.email as email_user',
                'users.no_wa as no_wa_user',
                'units.nama as nama_unit',
                'servers.deskripsi',
                'servers.no_rack',
                'servers.created_at',
            ]);
    }

    static function selectListUser()
    {
        return Server::selectList()->where('user_id', auth()->id());
    }

    function isiDariRequest($req)
    {
        $unit_id = Unit::getIdFromUnitOrCreate($req->unit, $req->tipeUnit);
        $keperuntukan_id = Unit::getIdFromUnitOrCreate($req->keperuntukan, $req->tipeKeperuntukan);

        $this->fill([
            'unit_id' => $unit_id,
            'keperuntukan_id' => $keperuntukan_id,
            'deskripsi' => $req->deskripsi,
            'no_rack' => $req->noRack,
        ]);
    }

    static function serverBaru($req)
    {
        $server = new Server();
        $server->user_id = auth()->id();
        $server->isiDariRequest($req);
        $server->save();

        return $server;
    }

    function user()
    {
        return $this->belongsTo('App\User');
    }

    function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }
}
