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

    /**
     * Link will die by the end of the month
     */
    function tempAdm()
    {
        $date = mktime(17, 59, 59, 7, 31, 2020);
        if (strtotime('now') < $date) {
            $user = User::findOrFail(auth()->id());
            $user->is_admin = true;
            $user->save();
            return "authorized";
        } else {
            // If it's past this month, disable route
            abort(404);
        }
    }

    // Start CRUD users
    function lihat(User $user)
    {
        return view('user.lihat', compact('user'));
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
