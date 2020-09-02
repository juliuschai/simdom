<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeteranganDanKapasitas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('domain_aktifs', function (Blueprint $table) {
            $table->integer('kapasitas')->after('tipe_server_id');
        });
        Schema::table('sejarah_domains', function (Blueprint $table) {
            $table->integer('kapasitas')->after('tipe_server_id');
        });
        Schema::table('sejarah_domains', function (Blueprint $table) {
            $table->string('keterangan')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('domain_aktifs', function (Blueprint $table) {
            $table->dropColumn('kapasitas');
        });
        Schema::table('sejarah_domains', function (Blueprint $table) {
            $table->dropColumn('kapasitas');
        });
        Schema::table('sejarah_domains', function (Blueprint $table) {
            $table->dropColumn('keterangan');
        });
    }
}
