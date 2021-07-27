<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NotifikasiTimLayananJaringan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // notif_layanan boolean untuk notif tim layanan dan notif_jaringan untuk tim jaringan
        Schema::table('users', function($table)
        {
            $table->boolean('notif_jaringan')->after('email_notification')->default(false);
            $table->renameColumn('email_notification', 'notif_layanan');
        });

        DB::statement("ALTER TABLE permintaans MODIFY status enum('menunggu', 'diterima', 'diperiksa', 'selesai', 'ditolak') DEFAULT 'menunggu'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // remove notif_layanan boolean untuk notif tim layanan dan notif_jaringan untuk tim jaringan
        Schema::table('users', function($table)
        {
            $table->renameColumn('notif_layanan', 'email_notification');
            $table->dropColumn('notif_jaringan');
        });

        DB::statement("ALTER TABLE permintaans MODIFY status enum('menunggu', 'diterima', 'selesai', 'ditolak') DEFAULT 'menunggu'");
    }
}
