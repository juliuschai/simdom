<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitRequest;
use App\Models\TipeUnit;
use App\Models\Unit;

use DataTables;

class UnitController extends Controller
{
    function listData()
    {
        $model = Unit::selectList()->newQuery();

        return DataTables::eloquent($model)->toJson();
    }

    function list()
    {
        return view('unit.list');
    }

    function formBaru()
    {
        $tipeUnits = TipeUnit::orderBy('nama')->get();

        return view('unit.baru', compact('tipeUnits'));
    }
    
    function simpanBaru(UnitRequest $req)
    {
        Unit::simpanBaru($req);

        return redirect()->route('unit.list');
    }
    
    function formEdit(Unit $unit)
    {
        $tipeUnits = TipeUnit::orderBy('nama')->get();

        return view('unit.edit', compact('unit', 'tipeUnits'));
    }

    function simpanEdit(Unit $unit, UnitRequest $req)
    {
        $unit->isiDariRequest($req);
        $unit->save();

        return redirect()->route('unit.list');
    }
}
