<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEventos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos',function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->string('nombre_evento');         
            $table->string('color')->default(null);     
            $table->boolean('dia_completo')->default(false);
            $table->dateTime("fecha_inicio");
            $table->dateTime("fecha_fin");
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eventos', function(Blueprint $table){
            $table->dropForeign('eventos_id_user_foreign');
        });

        Schema::dropIfExists('eventos');
    }
}
