<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NamaDomainDiajukan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // add 'terlantar' in aktif column enums
        DB::statement("ALTER TABLE domains MODIFY COLUMN aktif ENUM('aktif', 'nonaktif', 'terlantar')");

        // add keperuntukan column
        Schema::table('tipe_units', function($table)
        {
            $table->boolean('keperuntukan')->default(true);
        });
        // all is keperuntukan except first 3 tipe_units
        DB::table('tipe_units')->whereIn('id', [1, 2, 3])->update(['keperuntukan' => false]);

        // add domain yang diinginkan column
        Schema::table('permintaans', function($table)
        {
            $table->string('domain_diajukan')->nullable()->after('ip');
            $table->foreignId('keperuntukan_id')->nullable()->after('unit_id')->constrained('units')->onUpdate('CASCADE');
        });

        // add formal column
        Schema::table('domains', function($table)
        {
            $table->boolean('formal')->default(false)->after('aktif');
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
        // remove formal column
        Schema::table('domains', function($table)
        {
            $table->dropColumn('formal');
            $table->dropColumn('keperuntukan_id');
        });

        // remove domain yang diinginkan column
        Schema::table('permintaans', function($table)
        {
            $table->dropColumn('domain_diajukan');
            $table->dropColumn('keperuntukan_id');
        });

        // remove keperuntukan column
        Schema::table('tipe_units', function($table)
        {
            $table->dropColumn('keperuntukan');
        });

        // roll back aktif column enums
        DB::table('domains')->where('aktif', 'terlantar')->update(['aktif' => 'aktif']);
        DB::statement("ALTER TABLE domains MODIFY COLUMN aktif ENUM('aktif', 'nonaktif')");

    }
}
