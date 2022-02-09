<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instansis', function($table) {
            $table->foreign('users_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')->onUpdate('restrict');
        });
        
        Schema::table('klasifikasi', function($table) {
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
        Schema::table('instansis', function($table) {
            $table->dropForeign('users_id');
        });

        Schema::table('klasifikasi', function($table) {
            $table->dropForeign('users_id');
        });
        
    }
}
