<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\OIDCHelper;

class OIDCController extends Controller
{
    function login(Request $request)
    {
        OIDCHelper::login();
        return redirect()->route('home');
    }

    function logout(Request $request)
    {
        OIDCHelper::logout();
        return redirect()->route('home');
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
}
