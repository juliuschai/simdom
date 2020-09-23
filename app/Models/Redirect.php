<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    protected $guarded = [];

    static function selectList()
    {
        return Redirect::select([
                'id',
                'link_lama',
                'link_baru',
                'keterangan',
                'created_at'
            ]);
    }

    function isiDariRequest($req)
    {
        $this->fill([
            'link_lama' => $req->linkLama,
            'link_baru' => $req->linkBaru,
            'keterangan' => $req->keterangan,
        ]);
    }

    static function redirectBaru($req)
    {
        $redirect = new Redirect();
        $redirect->isiDariRequest($req);
        $redirect->save();

        return $redirect;
    }
}
