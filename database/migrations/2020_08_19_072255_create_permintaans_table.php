<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermintaansTable extends Migration
{
    public function up()
    {
        Schema::create('permintaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domain_id')->nullable()->constrained()->onUpdate('CASCADE');
            $table->foreignId('user_id')->constrained()->onUpdate('CASCADE');
            $table->foreignId('unit_id')->constrained()->onUpdate('CASCADE');
            $table->string('ip', 16)->nullable();
            $table->string('nama_domain', 60);
            $table->string('deskripsi')->comment('nama panjang/penjelasan isi/tujuan domain');
            $table->string('surat')->nullable();
            $table->foreignId('server_id')->constrained()->onUpdate('CASCADE');
            $table->integer('kapasitas');
            $table->enum('status', ['menunggu', 'diterima', 'selesai', 'ditolak'])->default('menunggu');
            $table->string('keterangan');
            $table->timestamp('waktu_konfirmasi')->nullable()->default(null)
                ->comment('waktu admin memverifikasi permintaan');
            $table->timestamp('waktu_selesai')->nullable()->default(null)
                ->comment('waktu IKTI selesai melakukan/memenuhi permintaan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permintaans');
    }
}
