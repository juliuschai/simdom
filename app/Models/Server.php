<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $table = "data_server";

    static function viewServerList() {
        return Server::select(['id_server as id', 'nama_server', 'type_server', 'tgl_aktif', 
            'lokasi_server', 'no_rack']);
    }

    static function viewServerList2() {
        return Server::get();
    }

}
