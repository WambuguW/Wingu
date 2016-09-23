<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if(Schema::hasTable('examtypes')){
		
		} else{
        Schema::create('examtypes', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name', 255);
                $table->unsignedInteger('outof');
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
        Schema::drop('examtypes');
    }
}