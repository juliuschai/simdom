<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServerKeperuntukanId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // add keperuntukan id for servers
        Schema::table('servers', function($table)
        {
            $table->foreignId('keperuntukan_id')->nullable()->after('unit_id')->constrained('units')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // remove keperuntukan id for servers
        Schema::table('servers', function($table)
        {
            $table->dropColumn('keperuntukan_id');
        });

    }
}
