<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if(Schema::hasTable('subjects')){
		
		} else{
        Schema::create('subjects', function(Blueprint $table) {
                $table->increments('id');
                $table->string('code', 255);
                $table->string('name', 255);
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
        Schema::drop('subjects');
    }
}