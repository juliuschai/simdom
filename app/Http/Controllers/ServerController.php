<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServerRequest;
use App\Models\Server;

use DataTables;

class ServerController extends Controller
{
    function listData()
    {
        $model = Server::selectList()->newQuery();

        return DataTables::eloquent($model)->toJson();
    }

    function list()
    {
        return view('server.list');
    }

    function formBaru()
    {
        $server = new Server();

        return view('server.form', compact('server'));
    }

    function simpanBaru(ServerRequest $req)
    {
        $server = Server::serverBaru($req);

        return redirect()->route('server.edit', ['server' => $server->id]);
    }

    function formEdit(Server $server)
    {
        return view('server.form', compact('server'));
    }

    function saveEdit(Server $server, ServerRequest $req)
    {
        $server->perbaharuiDariRequest($req);

        return redirect()->route('server.edit', ['server' => $server->id]);
    }

    function hapus(Server $server)
    {
        $server->delete();

        return redirect()->route('server.list');
    }
}
