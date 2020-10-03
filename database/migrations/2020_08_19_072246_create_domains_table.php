<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('CASCADE');
            $table->foreignId('unit_id')->constrained()->onUpdate('CASCADE');
            $table->string('ip', 16)->nullable();
            $table->string('nama_domain', 60)->nullable();
            $table->string('deskripsi')->comment('nama panjang/penjelasan isi/tujuan domain');
            $table->string('alias');
            $table->enum('server', ['WHS', 'VPS', 'Colocation']);
            $table->integer('kapasitas');
            $table->enum('status', ['siap', 'menunggu'])->default('siap')
                ->comment('Status menunggu menunjukkan domain sedang dalam prosesdiubah');
            $table->enum('aktif', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
            $table->date('reminder')->default(DB::raw('DATE_ADD(CURDATE(), INTERVAL 6 MONTH)'))
                ->comment('digunakan untuk mengirimkan reminder kepada PIC untuk memperbaharui data PIC');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domains');
    }
}
