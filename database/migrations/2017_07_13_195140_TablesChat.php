<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablesChat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat',function (Blueprint $table){
            $table->increments('id');
        });

        Schema::create('historial_chat',function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_chat')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->text('mensaje');
            $table->timestamps();         
            $table->foreign('id_chat')->references('id')->on('chat')->onDelete('cascade');            
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
        Schema::table('historial_chat', function(Blueprint $table){
            $table->dropForeign('historial_chat_user_id_foreign');
            $table->dropForeign('historial_chat_chat_id_foreign');
        });

        Schema::dropIfExists('historial_chat');
        Schema::dropIfExists('chat');
    }
}
