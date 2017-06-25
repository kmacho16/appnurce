<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaArchivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos_usuarios',function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->string('ruta');
            $table->foreign('id_user')->references('id')->on('users')->ondelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('archivos_usuarios', function(Blueprint $table){
            $table->dropForeign('archivos_usuarios_user_id_foreign');  
        });

        Schema::dropIfExists('archivos_usuarios');
    }
}
