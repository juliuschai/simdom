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

    protected $guarded = [];

    public $timestamps = false;

    static function selectList()
    {
        return Unit::join(
            'tipe_units',
            'tipe_units.id',
            '=',
            'units.tipe_unit_id'
        )->select(['units.id', 'units.nama', 'tipe_units.nama as tipe_unit']);
    }

    static function getDropdownOptions()
    {
        return Unit::join(
            'tipe_units',
            'tipe_units.id',
            '=',
            'units.tipe_unit_id'
        )
            ->orderBy('units.nama')
            ->get(['units.nama as second_val', 'tipe_units.nama as first_val']);
    }

    function isiDariRequest($req)
    {
        $unit = $this->fill([
            'nama' => $req->nama,
            'tipe_unit_id' => $req->tipeUnit,
        ]);

        return $unit;
    }
    static function viewUnitBuilder()
    {
        return Unit::join(
            'tipe_units',
            'tipe_units.id',
            '=',
            'units.unit_type_id'
        )->select(['units.id', 'units.nama', 'tipe_units.nama as unit_type']);
    }

    function tipeUnit()
    {
        return $this->belongsTo('App\Models\TipeUnit');
    }
}
