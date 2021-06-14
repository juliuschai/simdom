<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NoRack extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // add no_rack column for permintaans
        Schema::table('permintaans', function($table)
        {
            $table->string('no_rack', 15)->nullable()->after('server');
        });
        // add no_rack column for domains
        Schema::table('domains', function($table)
        {
            $table->string('no_rack', 15)->nullable()->after('server');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // remove no_rack column for permintaans
        Schema::table('permintaans', function($table)
        {
            $table->dropColumn('no_rack');
        });

        // remove no_rack column for domains
        Schema::table('domains', function($table)
        {
            $table->dropColumn('no_rack');
        });
    }
}
