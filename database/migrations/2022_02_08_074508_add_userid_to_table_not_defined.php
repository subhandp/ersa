<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUseridToTableNotDefined extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instansis', function (Blueprint $table) {
            $table->integer('users_id')->unsigned();
            
        });

        Schema::table('klasifikasi', function (Blueprint $table) {
            $table->integer('users_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instansis', function (Blueprint $table) {
            $table->dropColumn('users_id');
            
        });

        Schema::table('klasifikasi', function (Blueprint $table) {
            $table->dropColumn('users_id');
        });
    }
}
