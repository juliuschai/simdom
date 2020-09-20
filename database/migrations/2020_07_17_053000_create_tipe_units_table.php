<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipeUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipe_units', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('nama');
            $table->string('domain_template');
        });

        DB::table('tipe_units')->insert([
            ['nama' => 'Departemen', 'domain_template' => 'its.ac.id/*'],
            ['nama' => 'Fakultas', 'domain_template' => 'its.ac.id/*'],
            ['nama' => 'Direktorat/Kantor/Unit/Biro', 'domain_template' => 'its.ac.id/*'],

            ['nama' => 'Kemahasiswaan/Ormawa', 'domain_template' => 'arek.its.ac.id/*'],
            ['nama' => 'Seminar/Workshop', 'domain_template' => 'arek.its.ac.id/*'],

            ['nama' => 'Pusat Studi', 'domain_template' => 'riset.its.ac.id/*'],

            ['nama' => 'eLib Jurnal', 'domain_template' => 'elib.its.ac.id/jurnal/*'],
            ['nama' => 'eLib Conference', 'domain_template' => 'elib.its.ac.id/conf/*'],

            ['nama' => 'Lain-lain', 'domain_template' => 'sites.its.ac.id/*'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipe_units');
    }
}
