<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static function selectList()
    {
        return User::select([
            'id',
            'nama',
            'email',
            'integra',
            'no_wa',
            'group',
            'role',
            'notif_layanan',
            'notif_jaringan',
        ]);
    }

    /**
     * Cari user yang sedang login, jika tidak ditemukan maka re-login user
     * @param Number id dari user yang login
     * @return User user user model yang sekarang login
     */
    static function findOrLogout($id)
    {
        $user = User::find($id);
        if (!$user) {
            Auth::logout();
            abort('403', 'Mohon login kembali');
        }
        return $user;
    }

    function isAdmin()
    {
        return $this->role === 'admin';
    }
}
