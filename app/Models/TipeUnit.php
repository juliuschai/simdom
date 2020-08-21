<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipeUnit extends Model
{
    /**
     * id
     * nama
     */
    public $timestamps = false;

    function units()
    {
        return $this->hasMany('App\Models\Unit', 'tipe_unit_id', 'id');
    }
}
