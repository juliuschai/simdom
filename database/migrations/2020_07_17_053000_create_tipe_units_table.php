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
        });

        DB::table('tipe_units')->insert([
            ['nama' => 'Departemen'],
            ['nama' => 'Fakultas'],
            ['nama' => 'Direktorat/Kantor/Unit/Biro'],
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
