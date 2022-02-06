<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('suratmasuk_files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filemasuk');
            $table->integer('suratmasuk_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('suratkeluar_files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filekeluar');
            $table->integer('suratkeluar_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suratmasuk_files');
        Schema::dropIfExists('suratkeluar_files');
    }
}
