<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    function viewNewServer(Request $request)
    {
        return view('server.form');
    }
}
