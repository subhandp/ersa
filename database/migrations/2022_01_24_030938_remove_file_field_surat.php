<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFileFieldSurat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suratmasuk', function (Blueprint $table) {
            $table->dropColumn('filemasuk');
        });

        Schema::table('suratkeluar', function (Blueprint $table) {
            $table->dropColumn('filekeluar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suratmasuk', function (Blueprint $table) {
            $table->string('filemasuk');
        });

        Schema::table('suratkeluar', function (Blueprint $table) {
            $table->string('filekeluar');
        });
    }
}
