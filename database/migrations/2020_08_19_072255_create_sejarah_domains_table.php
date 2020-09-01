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
            $table->foreignId('domain_aktif_id')->nullable()->constrained()->onUpdate('CASCADE');
            $table->foreignId('user_id')->constrained()->onUpdate('CASCADE');
            $table->foreignId('unit_id')->constrained()->onUpdate('CASCADE');
            $table->string('nama_domain', 60);
            $table->string('nama_panjang');
            $table->string('surat')->nullable(); // PART: max path character amount
            $table->foreignId('tipe_server_id')->constrained()->onUpdate('CASCADE');
            $table->enum('status', ['menunggu', 'diterima', 'selesai', 'ditolak'])->default('menunggu');
            $table->timestamp('waktu_konfirmasi')->nullable()->default(null)
                ->comment('waktu admin memverifikasi permintaan');
            $table->timestamp('waktu_selesai')->nullable()->default(null)
                ->comment('waktu IKTI selesai melakukan/memenuhi permintaan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sejarah_domains');
    }
}
