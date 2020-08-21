<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainAktifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain_aktifs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pj');
            $table->string('nama_ins');
            $table->string('no_telp', 30);
            $table->string('email');
            $table->string('nama_domain');
            $table->string('jenis_domain');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domain_aktifs');
    }
}
