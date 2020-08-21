<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    /**
     * id
     * nama
     * tipe_unit_id
     */
    public $timestamps = false;

    static function viewUnitBuilder() {
        return Unit::join('tipe_units', 'tipe_units.id', '=', 'units.unit_type_id')
            ->select(['units.id', 'units.nama', 'tipe_units.nama as unit_type']);
    }

    /**
     * Get Unit list with ascending names
     */
    static function getDefault() {
        return Unit::orderBy('nama')->get();
    }

    function tipeUnit()
    {
        return $this->belongsTo('App\Models\TipeUnit');
    }
}
