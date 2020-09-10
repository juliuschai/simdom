<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(
    [
        'prefix' => 'v2',
        // 'domain' => Config::get('app.base_subdomain').'.'.Config::get('app.base_domain'),
    ],
    function () {
        Route::get('/welcome', function() {
            return view('welcome');
        });
        Route::get('/', 'OIDCController@login')->name('login');
        Route::get('/home', 'HomeController@index')->name('home');

        Route::get('/logout', function() { auth()->logout(); })->name('logout');

        Route::group(
            [
                'middleware' => ['auth'],
            ],
            function () {
                // Domain management
                Route::get('/domain/list', 'DomainController@list')->name('domain.list');
                Route::get('/domain/data', 'DomainController@listData')->name('domain.data');

                Route::get('/domain/baru', 'DomainController@formDomainBaru')->name('domain.baru');
                Route::post('/domain/baru', 'DomainController@simpanDomainBaru')->name('domain.baru');

                // Permintaan
                Route::get('/permintaan/list', 'PermintaanController@list')->name('permintaan.list');
                Route::get('/permintaan/data', 'PermintaanController@listData')->name('permintaan.data');

                Route::group(
                    [
                        'middleware' => ['adminOrOwner'],
                    ],
                    function () {
                        // Domain management
                        Route::get('/domain/{domain}/edit', 'DomainController@formEditDomain')->name('domain.edit');
                        Route::post('/domain/{domain}/edit', 'DomainController@saveEditDomain')->name('domain.edit');

                        // hanya bisa dilakukan jika permintaan belum diproses (masih dalam status menunggu)
                        Route::get('/permintaan/{permintaan}/lihat', 'PermintaanController@lihatPermintaan')->name('permintaan.lihat');
                        Route::post('/permintaan/{permintaan}/hapus', 'PermintaanController@hapusPermintaan')->name('permintaan.hapus');
                    }
                );

                Route::group(
                    [
                        'middleware' => ['admin'],
                    ],
                    function () {
                        // Server
                        Route::get('/server/list', 'ServerController@list')->name('server.list');
                        Route::get('/server/data', 'ServerController@listData')->name('server.data');

                        Route::get('/server/baru', 'ServerController@formServerBaru')->name('server.baru');
                        Route::post('/server/baru', 'ServerController@simpanServerBaru')->name('server.baru');
                        Route::get('/server/{server}/edit', 'ServerController@formEditServer')->name('server.edit');
                        Route::post('/server/{server}/edit', 'ServerController@saveEditServer')->name('server.edit');
                        Route::post('/server/{server}/hapus', 'ServerController@hapusServer')->name('server.hapus');

                        // Ubah status Permintaan
                        Route::post('/permintaan/{permintaan}/terima', 'PermintaanController@terimaPermintaan')->name('permintaan.terima');
                        Route::post('/permintaan/{permintaan}/selesai', 'PermintaanController@selesaiPermintaan')->name('permintaan.selesai');
                        Route::post('/permintaan/{permintaan}/tolak', 'PermintaanController@tolakPermintaan')->name('permintaan.tolak');

                        // Set domain nonaktif
                        Route::post('/domain/{domain}/nonaktif', 'DomainController@nonaktifasiDomain')->name('domain.nonaktifasi');

                        Route::get('/user/list', 'UserController@list')->name('user.list');
                        Route::get('/user/data', 'UserController@listData')->name('user.data');
                    }
                );
            }
        );
    }
);
