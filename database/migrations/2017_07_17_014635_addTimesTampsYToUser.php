<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimesTampsYToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eventos',function(Blueprint $table){
            $table->timestamps();
            $table->integer('to_id_user')->unsigned()->after('id_user')->default(0);                        
            $table->foreign('to_id_user')->references('id')->on('users')->onDelete('cascade');
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
            $table->dropForeign('eventos_to_id_user_foreign');
            $table->dropColumn('to_id_user');
        });
    }
}
