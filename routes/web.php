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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Domain management
Route::get('domain/permintaan/baru', 'PermintaanController@lihatPermintaanBaru')->name('domain.permintaan.baru'); //
Route::post('domain/permintaan/baru', 'PermintaanController@simpanPermintaanBaru')->name('domain.permintaan.baru');

Route::get('/domain/new', 'DomainController@viewNewDomain')->name('domain.new');
Route::get('/domain/list', 'DomainController@listDomain')->name('domain.list');
Route::get('/domain/data', 'DomainController@listDomainData')->name('domain.data');
Route::post('/domain/delete/{id}', 'DomainController@deleteDomain')->name('domain.delete');
// Server management
Route::get('/server/new', 'ServerController@viewNewServer')->name('server.new');
Route::get('/server/list', 'ServerController@listServer')->name('server.list');
Route::get('/server/data', 'ServerController@listServerData')->name('server.data');
Route::post('/server/delete/{id}', 'ServerController@deleteServer')->name('server.delete');
// Admin
