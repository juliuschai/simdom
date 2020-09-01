<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipeServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipe_servers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_server');
            $table->string('lokasi_server')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });

        DB::table('tipe_servers')->insert([
            [
                'nama_server' => 'WHS',
                'lokasi_server' => 'Gedung Perpustakaan ITS lt. 6',
                'keterangan' => null,
                'created_at' => '2015-11-26 08:42:10',
            ],
            [
                'nama_server' => 'VPS (Virtual Server)',
                'lokasi_server' => 'Data Center LPTSI',
                'keterangan' => null,
                'created_at' => '2015-11-27 07:38:39',
            ],
            [
                'nama_server' => 'Collocation',
                'lokasi_server' => 'Gedung Perpustakaan ITS lt. 6',
                'keterangan' => null,
                'created_at' => '2015-11-27 07:39:17',
            ],
            [
                'nama_server' => 'Lain - lain',
                'lokasi_server' => 'Gedung Perpustakaan ITS lt. 6',
                'keterangan' => null,
                'created_at' => '2015-12-02 03:52:17',
            ],
            [
                'nama_server' => 'WHS v2',
                'lokasi_server' => 'Data Center DPTSI',
                'keterangan' => null,
                'created_at' => '2017-03-15 14:09:46',
            ],
            [
                'nama_server' => 'Hosting Luar ITS',
                'lokasi_server' => 'Di Luar ITS',
                'keterangan' => 'Server di Hosting Luar ITS',
                'created_at' => '2018-01-12 14:18:52',
            ],
            [
                'nama_server' => 'Lyra',
                'lokasi_server' => null,
                'keterangan' => null,
                'created_at' => '2018-02-20 10:45:08',
            ],
            [
                'nama_server' => 'Lyra v2',
                'lokasi_server' => 'DPTSI',
                'keterangan' => 'Lyra (202.46.129.20)',
                'created_at' => '2018-02-20 10:47:19',
            ],
            [
                'nama_server' => 'Server Web ITS',
                'lokasi_server' => null,
                'keterangan' => null,
                'created_at' => '2018-04-19 14:14:22',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipe_servers');
    }
}
