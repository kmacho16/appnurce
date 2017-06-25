<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CampoRolUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('users',function(Blueprint $table){
            $table->integer('id_rol')->unsigned()->default('3')->after('id');
            /*$table->foreign('id_rol')->references('id')->on('roles');*/
            $table->foreign('id_rol')->references('id')->on('roles')->ondelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropForeign('roles_user_id_foreign');  
        });

    }
}
