<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if(Schema::hasTable('users')){
		
		} else{
        Schema::create('users', function(Blueprint $table){
           //auto incremental id (PK)
            $table->increments('id');
            $table->string('name', 255);
            $table->string('username', 32);
            $table->string('email', 255);
            $table->string('password', 64);
            $table->integer('role');
            $table->boolean('active');
            $table->timestamps();
        });
		}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}