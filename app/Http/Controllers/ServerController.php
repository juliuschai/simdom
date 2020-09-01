<?php

namespace App\Http\Controllers;

use App\Models\Server;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

use DataTables;

class ServerController extends Controller
{
    function viewNewServer(Request $request)
    {
        return view('server.form');
    }

    function listServerData() {
        $model = Server::viewServerList()
            ->newQuery();

        return DataTables::eloquent($model)
            ->toJson();
    }

    function listServer(Request $request) {
        $servers = Server::viewServerList()
            ->orderBy('id')
            ->paginate('10');

        $length = Server::count();
        return view('server.list', compact(['servers', 'length']));
    }

    function deleteServer(Request $request)
    {
        $id = $request['id'];
        Server::destroy($id);

        return redirect()->route('server.list');
    }
}
