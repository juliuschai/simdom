<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('sub', 40)->comment('user_id from OpenID');
            $table->string('email', 60);
            $table->string('nama', 60);
            $table->string('integra', 20);
            $table->string('no_wa', 20);
            $table->string('group', 20);
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->timestamps();
        });

        DB::table('users')->insert([
            'sub' => '51D15B2E-FE38-41A8-A8A6-43A2745C4B31',
            'email' => 'julius.18051@mhs.its.ac.id',
            'nama' => 'Julius',
            'integra' => '05111840000082',
            'no_wa' => '089604058768',
            'group' => 'Mahasiswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
