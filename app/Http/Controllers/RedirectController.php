<?php

namespace App\Http\Controllers;

use App\Http\Requests\RedirectRequest;
use App\Models\Redirect;
use Illuminate\Http\Request;
use DataTables;

class RedirectController extends Controller
{
    function listData()
    {
        $model = Redirect::selectList()->newQuery();

        return DataTables::eloquent($model)->toJson();
    }

    function list()
    {
        return view('redirect.list');
    }

    function formBaru()
    {
        $redirect = new Redirect();

        return view('redirect.form', compact('redirect'));
    }

    function simpanBaru(RedirectRequest $req)
    {
        $redirect = Redirect::redirectBaru($req);

        return redirect()
            ->route('redirect.edit', ['redirect' => $redirect->id])
            ->with('message', 'Redirect record berhasil dibuat!');
    }

    function formEdit(Redirect $redirect)
    {
        return view('redirect.form', compact('redirect'));
    }

    function simpanEdit(Redirect $redirect, RedirectRequest $req)
    {
        $redirect->isiDariRequest($req);
        $redirect->save();

        return redirect()
            ->route('redirect.edit', ['redirect' => $redirect->id])
            ->with('message', 'Redirect record berhasil diedit!');
    }

    function hapus(Redirect $redirect)
    {
        $redirect->delete();

        return redirect()->route('redirect.list');
    }

    function formExport() {
        return view('redirect.export');
    }

    function  downloadExport(Request $req) {
        return Redirect::export($req);
    }
}
