<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InviteFriends extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invite_friend', function (Blueprint $table) {
            $table->increments('id',true);
            $table->integer('id_send')->unsigned();
            $table->integer('id_receive')->unsigned();
            $table->foreign('id_send')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_receive')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invite_friend');
    }
}
