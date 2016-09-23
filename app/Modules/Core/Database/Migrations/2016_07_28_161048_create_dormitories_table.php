<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDormitoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if(Schema::hasTable('dormitories')){
		
		} else{
        Schema::create('dormitories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->unsignedInteger('capacity');
            $table->string('sex', 255);
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
        Schema::drop('dormitories');
    }
}