<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSejarahDomainsTable extends Migration
{
    public function up()
    {
        Schema::create('sejarah_domains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('domain_aktif_id')->nullable();
            $table->foreign('domain_aktif_id')->references('id')->on('domain_aktifs')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->string('nama_pj');
            $table->string('nama_ins');
            $table->string('no_telp', 30);
            $table->string('email');
            $table->date('tgl_pengajuan', 50);
            $table->string('nama_domain');
            $table->string('jenis_domain');
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sejarah_domains');
    }
}
