<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suratmasuk_files', function (Blueprint $table) {
            $table->string('filepath');
            $table->string('extension', 100);
            $table->string('mimetypes', 100);
            $table->string('disk', 100);
            $table->string('filename');
            $table->integer('users_id')->unsigned();
            $table->dateTime('expires_at')->nullable();
            $table->foreign('users_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('suratkeluar_files', function (Blueprint $table) {
            $table->string('filepath');
            $table->string('extension', 100);
            $table->string('mimetypes', 100);
            $table->string('disk', 100);
            $table->string('filename');
            $table->integer('users_id')->unsigned();
            $table->dateTime('expires_at')->nullable();
            $table->foreign('users_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suratkeluar_files', function (Blueprint $table) {
            $table->dropForeign('users_id'); 
            $table->dropColumn('filekeluar');
            $table->dropColumn('extension');
            $table->dropColumn('mimetypes');
            $table->dropColumn('disk');
            $table->dropColumn('filepath');
            $table->dropColumn('users_id');
            $table->dropColumn('expires_at');
        });

        

        Schema::table('suratmasuk_files', function (Blueprint $table) {
            $table->dropForeign('users_id'); 
            $table->dropColumn('filekeluar');
            $table->dropColumn('extension');
            $table->dropColumn('mimetypes');
            $table->dropColumn('disk');
            $table->dropColumn('filepath');
            $table->dropColumn('users_id');
            $table->dropColumn('expires_at');
        });
    }
}
