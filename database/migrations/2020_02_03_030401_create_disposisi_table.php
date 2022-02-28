<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisposisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposisis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tujuan');
            $table->string('isi');
            $table->string('sifat');
            $table->date('batas_waktu');
            $table->string('catatan');
            $table->integer('users_id')->unsigned();
            $table->integer('suratmasuk_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('suratmasuk', function($table) {
            $table->foreign('users_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('suratkeluar', function($table) {
            $table->foreign('users_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('disposisis', function($table) {
            $table->foreign('users_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('disposisis', function($table) {
            $table->foreign('suratmasuk_id')
                  ->references('id')->on('suratmasuk')
                  ->onDelete('cascade')->onUpdate('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disposisi');
    }
}
