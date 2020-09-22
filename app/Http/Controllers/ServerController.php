<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServerRequest;
use App\Models\Server;
use App\Models\TipeUnit;
use App\Models\Unit;
use App\User;
use DataTables;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    function listData()
    {
        $user = User::findOrLogout(auth()->id());
        if ($user->isAdmin()) {
            $model = Server::selectList()->newQuery();
        } else {
            $model = Server::selectListUser()->newQuery();
        }

        return DataTables::eloquent($model)->toJson();
    }

    function list()
    {
        return view('server.list');
    }

    function formBaru()
    {
        $user = User::findOrLogout(auth()->id());
        $server = new Server();
        $units = Unit::getDropdownOptions();
        $tipeUnits = TipeUnit::getDropdownOptions();

        return view(
            'server.form',
            compact('user', 'server', 'units', 'tipeUnits')
        );
    }

    function simpanBaru(ServerRequest $req)
    {
        $server = Server::serverBaru($req);

        return redirect()
            ->route('server.edit', ['server' => $server->id])
            ->with('message', 'Server colocation berhasil dibuat!');
    }

    function formEdit(Server $server)
    {
        $user = $server->user;
        $units = Unit::getDropdownOptions();
        $tipeUnits = TipeUnit::getDropdownOptions();

        return view(
            'server.form',
            compact('user', 'server', 'units', 'tipeUnits')
        );
    }

    function simpanEdit(Server $server, ServerRequest $req)
    {
        $server->isiDariRequest($req);
        $server->save();

        return redirect()
            ->route('server.edit', ['server' => $server->id])
            ->with('message', 'Server colocation berhasil diedit!');
    }

    function formTransfer(Server $server)
    {
        $pemilik = $server->user;

        return view('transfer', compact('pemilik'));
    }

    function saveTransfer(Server $server, Request $req)
    {
        $user = User::findOrFail($req->id);
        $server->user_id = $user->id;
        $server->save();

        return redirect()->route('server.list');
    }

    function hapus(Server $server)
    {
        $server->delete();

        return redirect()->route('server.list');
    }
}
