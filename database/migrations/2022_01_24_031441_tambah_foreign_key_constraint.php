<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahForeignKeyConstraint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suratmasuk_files', function (Blueprint $table) {
            $table->foreign('suratmasuk_id')
                  ->references('id')->on('suratmasuk')
                  ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('suratkeluar_files', function (Blueprint $table) {
            $table->foreign('suratkeluar_id')
                  ->references('id')->on('suratkeluar')
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
        $table->dropForeign('suratmasuk_id'); 

        $table->dropForeign('suratkeluar_id'); 
    }
}
