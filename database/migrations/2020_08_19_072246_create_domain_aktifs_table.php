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
            $table->foreignId('user_id')->constrained()->onUpdate('CASCADE');
            $table->foreignId('unit_id')->constrained()->onUpdate('CASCADE');
            $table->string('ip_domain', 16)->nullable();
            $table->string('nama_domain', 60);
            $table->string('deskripsi');
            $table->string('alias');
            $table->foreignId('tipe_server_id')->constrained()->onUpdate('CASCADE');
            $table->integer('kapasitas');
            $table->enum('aktif', ['aktif', 'menunggu', 'nonaktif'])->default('aktif');
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
