<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CampoUserRecibe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('historial_chat',function(Blueprint $table){
            $table->integer('to_id_user')->after('id_user')->default('0');
            $table->boolean('leido')->after('mensaje')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('historial_chat',function(Blueprint $table){
            $table->dropColumn('to_id_user');
        });
    }
}
