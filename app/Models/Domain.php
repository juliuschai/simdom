<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $table = "data_domain";

    static function viewDomainList() {
        return Domain::select(['id_data as id', 'name_pj', 'name_ins', 'no_tlp', 
            'name_domain','jenis_domain', 'kp_sekarang', 'ip_domain', 'tgl_input']);
    }

    static function viewDomainList2() {
        return Domain::get();
    }
}
