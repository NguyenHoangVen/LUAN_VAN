<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id',true);
            $table->integer('level');
            $table->string('username');
            $table->string('fullname');
            $table->string('email',100)->unique();
            $table->string('password');
            $table->enum('gender',['male','female']);
            $table->date('date_of_birth');
            $table->string('address');
            $table->string('avatar')->nullable();
            $table->string('img_cover')->nullable();
            $table->string('active_token')->nullable();
            $table->enum('is_active',[0,1]);
            $table->string('introduce')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
