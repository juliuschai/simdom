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

        Route::get('/logout', 'OIDCController@logout')->name('logout');

        Route::group(
            [
                'middleware' => ['auth'],
            ],
            function () {
                // Domain management
                Route::get('/domain/list', 'DomainController@list')->name('domain.list');
                Route::get('/domain/data', 'DomainController@listData')->name('domain.data');

                Route::get('/domain/baru', 'DomainController@formBaru')->name('domain.baru');
                Route::post('/domain/baru', 'DomainController@simpanBaru')->name('domain.baru');

                // Permintaan
                Route::get('/permintaan/list', 'PermintaanController@list')->name('permintaan.list');
                Route::get('/permintaan/data', 'PermintaanController@listData')->name('permintaan.data');

                Route::get('/user/cari', 'UserController@cari')->name('user.cari');
                Route::group(
                    [
                        'middleware' => ['adminOrOwner'],
                    ],
                    function () {
                        // Domain management dari pemilik
                        Route::get('/domain/{domain}/edit', 'DomainController@formEdit')->name('domain.edit');
                        Route::post('/domain/{domain}/edit', 'DomainController@simpanEdit')->name('domain.edit');
                        Route::get('/domain/{domain}/transfer', 'DomainController@formTransfer')->name('domain.transfer');
                        Route::post('/domain/{domain}/transfer', 'DomainController@saveTransfer')->name('domain.transfer');

                        // Permintaan management
                        Route::get('/permintaan/{permintaan}/lihat', 'PermintaanController@lihat')->name('permintaan.lihat');
                        Route::post('/permintaan/{permintaan}/hapus', 'PermintaanController@hapus')->name('permintaan.hapus');
                        // Get surat file dari permintaan
                        Route::get('/permintaan/{permintaan}/surat/get', 'FileController@getSurat')->name('surat.get');
                        Route::get('/permintaan/{permintaan}/surat/download', 'FileController@downloadSurat')->name('surat.download');
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

                        Route::get('/server/baru', 'ServerController@formBaru')->name('server.baru');
                        Route::post('/server/baru', 'ServerController@simpanBaru')->name('server.baru');
                        Route::get('/server/{server}/edit', 'ServerController@formEdit')->name('server.edit');
                        Route::post('/server/{server}/edit', 'ServerController@simpanEdit')->name('server.edit');
                        Route::post('/server/{server}/hapus', 'ServerController@hapus')->name('server.hapus');

                        // Ubah status Permintaan
                        Route::post('/permintaan/{permintaan}/terima', 'PermintaanController@terima')->name('permintaan.terima');
                        Route::post('/permintaan/{permintaan}/selesai', 'PermintaanController@selesai')->name('permintaan.selesai');
                        Route::post('/permintaan/{permintaan}/tolak', 'PermintaanController@tolak')->name('permintaan.tolak');

                        // Set domain nonaktif
                        Route::post('/domain/{domain}/nonaktif', 'DomainController@nonaktifasi')->name('domain.nonaktifasi');

                        // User management
                        Route::get('/user/list', 'UserController@list')->name('user.list');
                        Route::get('/user/data', 'UserController@listData')->name('user.data');
                        Route::get('/user/{user}/lihat', 'UserController@lihat')->name('user.lihat');
                        Route::post('/user/{user}/role/{role}', 'UserController@setRole')->name('user.role');
                        Route::post('/user/{user}/notif/{notif}', 'UserController@setNotif')->name('user.notif');

                        // Unit management
                        Route::get('/unit/list', 'UnitController@list')->name('unit.list');
                        Route::get('/unit/data', 'UnitController@listData')->name('unit.data');
                        Route::get('/unit/baru', 'UnitController@formBaru')->name('unit.baru');
                        Route::post('/unit/baru', 'UnitController@simpanBaru')->name('unit.baru');
                        Route::get('/unit/{unit}/edit', 'UnitController@formEdit')->name('unit.edit');
                        Route::post('/unit/{unit}/edit', 'UnitController@simpanEdit')->name('unit.edit');
                    }
                );
            }
        );
    }
);
