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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::group([
    // 'prefix' => 'v2',
    // 'domain' => Config::get('app.base_subdomain').'.'.Config::get('app.base_domain'),
    'middleware' => ['auth'],
], function () {


    // Domain management
    Route::get('/domain/baru', 'DomainController@formDomainBaru')->name('domain.baru');
    Route::post('/domain/baru', 'DomainController@simpanDomainBaru')->name('domain.baru');
    // Server management
    Route::get('/server/new', 'ServerController@formNewServer')->name('server.new');

    Route::group(['middleware' => ['adminOrOwner']], function () {
        Route::get('/domain/list', 'DomainController@listDomain')->name('domain.list');
        Route::get('/domain/data', 'DomainController@listDomainData')->name('domain.data');
        Route::post('/domain/delete/{id}', 'DomainController@deleteDomain')->name('domain.delete');
        Route::get('domain/{domain}')->name('domain.edit');

        Route::get('/server/list', 'ServerController@listServer')->name('server.list');
        Route::get('/server/data', 'ServerController@listServerData')->name('server.data');
        Route::post('/server/delete/{id}', 'ServerController@deleteServer')->name('server.delete');

        Route::get('/permintaan/{permintaan}', 'PermintaanController@lihatPermintaan')->name('permintaan.lihat');
    });

    Route::group(['middleware' => ['admin']], function () {
        // Admin
        Route::post('/permintaan/terima/{permintaan}', 'PermintaanController@terimaPermintaan')->name('permintaan.terima');
        Route::post('/permintaan/selesai/{permintaan}', 'PermintaanController@selesaiPermintaan')->name('permintaan.selesai');
        Route::post('/permintaan/tolak/{permintaan}', 'PermintaanController@tolakPermintaan')->name('permintaan.tolak');
    });
});
