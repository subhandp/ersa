<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HapusFieldSuratFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suratmasuk_files', function (Blueprint $table) {
            $table->dropForeign(['users_id']); 
            $table->dropColumn('filemasuk');
            $table->dropColumn('users_id');

        });

        Schema::table('suratkeluar_files', function (Blueprint $table) {
            $table->dropForeign(['users_id']); 
            $table->dropColumn('filekeluar');
            $table->dropColumn('users_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suratmasuk_files', function (Blueprint $table) {
            $table->string('filemasuk');
            $table->integer('users_id')->unsigned();

        });

        Schema::table('suratkeluar_files', function (Blueprint $table) {
            $table->string('filekeluar');
            $table->integer('users_id')->unsigned();
        });
    }
}
