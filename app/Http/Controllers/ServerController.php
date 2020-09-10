<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServerRequest;
use App\Models\TipeServer;
use Illuminate\Http\Request;

use DataTables;

class ServerController extends Controller
{
    function listData()
    {
        $model = TipeServer::selectList()->newQuery();

        return DataTables::eloquent($model)->toJson();
    }

    function list()
    {
        return view('server.list');
    }

    function formServerBaru()
    {
        $server = new TipeServer();
        return view('server.form', compact('server'));
    }

    function simpanServerBaru(ServerRequest $req)
    {
        $server = TipeServer::serverBaru($req);

        return redirect()->route('server.edit', ['server' => $server->id]);
    }

    function formEditServer(TipeServer $server)
    {
        return view('server.form', compact('server'));
    }

    function saveEditServer(TipeServer $server, ServerRequest $req)
    {
        $server->perbaharuiDariRequest($req);

        return redirect()->route('server.edit', ['server' => $server->id]);
    }

    function hapusServer(TipeServer $server)
    {
        $server->delete();

        return redirect()->route('server.list');
    }
}
