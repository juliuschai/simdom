<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedTinyInteger('tipe_unit_id');
            $table->foreign('tipe_unit_id')->references('id')->on('tipe_units')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });

        DB::table('units')->insert([
            ['nama' => "Fakultas Sains dan Analitika Data", 'tipe_unit_id' => 2],
            ['nama' => "Fisika", 'tipe_unit_id' => 1],
            ['nama' => "Matematika", 'tipe_unit_id' => 1],
            ['nama' => "Statistika", 'tipe_unit_id' => 1],
            ['nama' => "Kimia", 'tipe_unit_id' => 1],
            ['nama' => "Biologi", 'tipe_unit_id' => 1],
            ['nama' => "Aktuaria", 'tipe_unit_id' => 1],

            ['nama' => "Fakultas Teknologi Industri dan Rekayasa Sistem", 'tipe_unit_id' => 2],
            ['nama' => "Teknik Mesin", 'tipe_unit_id' => 1],
            ['nama' => "Teknik Kimia", 'tipe_unit_id' => 1],
            ['nama' => "Teknik Fisika", 'tipe_unit_id' => 1],
            ['nama' => "Teknik Industri", 'tipe_unit_id' => 1],
            ['nama' => "Teknik Material", 'tipe_unit_id' => 1],

            ['nama' => "Fakultas Teknik Sipil, Perencanaan dan Kebumian", 'tipe_unit_id' => 2],
            ['nama' => "Teknik Sipil", 'tipe_unit_id' => 1],
            ['nama' => "Arsitektur", 'tipe_unit_id' => 1],
            ['nama' => "Teknik Lingkungan", 'tipe_unit_id' => 1],
            ['nama' => "Perencanaan Wilayah Kota", 'tipe_unit_id' => 1],
            ['nama' => "Teknik Geomatika", 'tipe_unit_id' => 1],
            ['nama' => "Teknik Geofisika", 'tipe_unit_id' => 1],

            ['nama' => "Fakultas Teknologi Kelautan", 'tipe_unit_id' => 2],
            ['nama' => "Teknik Perkapalan", 'tipe_unit_id' => 1],
            ['nama' => "Teknik Sistem Perkapalan", 'tipe_unit_id' => 1],
            ['nama' => "Teknik Kelautan", 'tipe_unit_id' => 1],
            ['nama' => "Teknik Transportasi Laut", 'tipe_unit_id' => 1],

            ['nama' => "Fakultas Teknologi Elektro dan Informatika Cerdas", 'tipe_unit_id' => 2],
            ['nama' => "Teknik Elektro", 'tipe_unit_id' => 1],
            ['nama' => "Teknik Biomedik", 'tipe_unit_id' => 1],
            ['nama' => "Teknik Komputer", 'tipe_unit_id' => 1],
            ['nama' => "Teknik Informatika", 'tipe_unit_id' => 1],
            ['nama' => "Sistem Informasi", 'tipe_unit_id' => 1],
            ['nama' => "Teknologi Informasi", 'tipe_unit_id' => 1],

            ['nama' => "Fakultas Desain Kreatif dan Bisnis Digital", 'tipe_unit_id' => 2],
            ['nama' => "Desain Produk Industri", 'tipe_unit_id' => 1],
            ['nama' => "Desain Interior", 'tipe_unit_id' => 1],
            ['nama' => "Desain Komunikasi Visual", 'tipe_unit_id' => 1],
            ['nama' => "Manajemen Bisnis", 'tipe_unit_id' => 1],
            ['nama' => "Studi Pembangunan", 'tipe_unit_id' => 1],

            // Got from webinar-book
            ['nama' => "Fakultas Vokasi", 'tipe_unit_id' => 2],
            ['nama' => "Manajemen Teknologi", 'tipe_unit_id' => 1],
            ['nama' => "Teknik Infrastruktur Sipil", 'tipe_unit_id' => 1],
            ['nama' => "Teknik Mesin Industri", 'tipe_unit_id' => 1],
            ['nama' => "Teknik Elektro Otomasi", 'tipe_unit_id' => 1],
            ['nama' => "Teknik Kimia Industri", 'tipe_unit_id' => 1],
            ['nama' => "Teknik Instrumentasi", 'tipe_unit_id' => 1],
            ['nama' => "Statistika Bisnis", 'tipe_unit_id' => 1],
            
            ['nama' => "Kantor Penjaminan Mutu", 'tipe_unit_id' => 3],
            ['nama' => "Kantor Audit Internal", 'tipe_unit_id' => 3],
            ['nama' => "Sekretaris Institut", 'tipe_unit_id' => 3],
            ['nama' => "Direktorat Kemitraan Global", 'tipe_unit_id' => 3],
            ['nama' => "Direktorat Pendidikan", 'tipe_unit_id' => 3],
            ['nama' => "Direktorat Pascasarjana dan Pengembangan Akademik", 'tipe_unit_id' => 3],
            ['nama' => "Direktorat Kemahasiswaan", 'tipe_unit_id' => 3],
            ['nama' => "Perpustakaan", 'tipe_unit_id' => 3],
            ['nama' => "Direktorat Perencanaan dan Pengembangan", 'tipe_unit_id' => 3],
            ['nama' => "Biro Sarana dan Prasarana", 'tipe_unit_id' => 3],
            ['nama' => "Biro Keuangan", 'tipe_unit_id' => 3],
            ['nama' => "Direktorat SDM Unit", 'tipe_unit_id' => 3],
            ['nama' => "Biro Umum dan Reformasi Birokrasi", 'tipe_unit_id' => 3],
            ['nama' => "Direktorat Pengembangan Teknologi dan Sistem Informasi", 'tipe_unit_id' => 3],
            ['nama' => "Direktorat Riset dan Pengabdian kepada Masyarakat", 'tipe_unit_id' => 3],
            ['nama' => "Direktorat Inovasi dan Kawasan Sains Teknologi", 'tipe_unit_id' => 3],
            ['nama' => "Direktorat Kerjasama dan Pengelola Usaha", 'tipe_unit_id' => 3],
            ['nama' => "Unit Pengembangan Smart Eco Campus", 'tipe_unit_id' => 3],
            ['nama' => "UKPBJ", 'tipe_unit_id' => 3],
            ['nama' => "ITS", 'tipe_unit_id' => 3],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
}
