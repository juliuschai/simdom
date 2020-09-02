<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIpDomain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('domain_aktifs', function (Blueprint $table) {
            $table->string('ip_domain', 60)->after('unit_id');
        });
        Schema::table('sejarah_domains', function (Blueprint $table) {
            $table->string('ip_domain', 60)->after('unit_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('domain_aktifs', function (Blueprint $table) {
            $table->dropColumn('ip_domain');
        });
        Schema::table('sejarah_domains', function (Blueprint $table) {
            $table->dropColumn('ip_domain');
        });
    }
}
