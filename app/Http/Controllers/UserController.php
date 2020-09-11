<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use DataTables;

class UserController extends Controller
{
    function listData()
    {
        $model = User::selectList()->newQuery();

        return DataTables::eloquent($model)->toJson();
    }

    function list()
    {
        return view('user.list');
    }

    // Start CRUD users
    function lihat(User $user)
    {
        return view('user.lihat', compact('user'));
    }

    function cari(Request $request)
    {
        $user = null;
        if ($request->has('email')) {
            // Request by email
            $user = User::where('email', $request->email)->first();
        } elseif ($request->has('integra')) {
            // Request by integra
            $user = User::where('integra', $request->integra)->first();
        }
        return $user->toJSON();
    }

    function setRole(User $user, string $role)
    {
        $user->role = $role;
        $user->save();

        return redirect()
            ->route('user.lihat', ['user' => $user->id])
            ->with('message', "{$user->nama} peran user diubah");
    }

    function setNotif(User $user, string $bool)
    {
        $bool = $bool == 'true'; // cast string sebagai boolean
        $user->email_notification = $bool;
        $user->save();

        return redirect()
            ->route('user.lihat', ['user' => $user->id])
            ->with('message', "{$user->nama} notifikasi email diubah");
    }
}
