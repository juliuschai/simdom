<?php

namespace App\Http\Controllers;

use App\Models\DomainAktif;
use App\Models\SejarahDomain;
use App\Models\TipeUnit;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    function setNonAktif()
    {
        
    }

    function viewNewDomain(Request $request)
    {
        return view('domain.form');
    }

}
