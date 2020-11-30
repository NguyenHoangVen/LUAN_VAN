<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCofirmTool extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comfirm_tool', function (Blueprint $table) {
            $table->increments('id',true);
            $table->integer('user_id')->unsigned();
            $table->integer('tool_id')->unsigned();
            $table->integer('quaty');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tool_id')->references('id')->on('tool')->onDelete('cascade');
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
        Schema::dropIfExists('comfirm_tool');
    }
}
