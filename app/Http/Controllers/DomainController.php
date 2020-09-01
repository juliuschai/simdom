<?php

namespace App\Http\Controllers;

use App\Models\DomainAktif;
use App\Models\SejarahDomain;
use App\Models\TipeUnit;
use App\Models\Unit;
use App\Models\Domain;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

use DataTables;

class DomainController extends Controller
{
    function setNonAktif()
    {
        
    }

    function viewNewDomain(Request $request)
    {
        return view('domain.form');
    }

    function listDomainData() {
        $model = Domain::viewDomainList()
            ->newQuery();

        return DataTables::eloquent($model)
            ->toJson();
    }

    function listDomain(Request $request) {
        $domains = Domain::viewDomainList()
            ->orderBy('id')
            ->paginate('10');

        $length = Domain::count();
        return view('domain.list', compact(['domains', 'length']));
    }

    function deleteDomain(Request $request)
    {
        $id = $request['id'];
        Domain::destroy($id);

        return redirect()->route('domain.list');
    }

}
