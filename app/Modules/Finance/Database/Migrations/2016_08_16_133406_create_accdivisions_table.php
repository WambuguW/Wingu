<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccdivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('accdivisions')) {
		
	} else{
            Schema::create('accdivisions', function(Blueprint $table) {
                $table->increments('id');
                $table->string('code', 255);
                $table->string('name', 255);
                $table->string('description', 255);
                $table->string('funds', 100);
                $table->string('status', 10);
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
        Schema::drop('accdivisions');
    }
}