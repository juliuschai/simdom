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

    static function simpanBaru($req)
    {
        $unit = new Unit();
        $unit->isiDariRequest($req);
        $unit->save();

        return $unit;
    }

    function isiDariRequest($req)
    {
        $this->fill([
            'nama' => $req->nama,
            'tipe_unit_id' => $req->tipeUnit,
        ]);

        return $this;
    }

    static function getIdFromUnitOrCreate($unit, $tipe_unit)
    {
        $tipe_unit_id = TipeUnit::where('nama', $tipe_unit)->firstOrFail()->id;
        $unit = Unit::firstOrCreate([
            'nama' => $unit,
            'tipe_unit_id' => $tipe_unit_id,
        ]);

        return $unit->id;
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
