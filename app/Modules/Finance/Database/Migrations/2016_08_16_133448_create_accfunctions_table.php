<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccfunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('accfunctions')) {
		
	} else{
            Schema::create('accfunctions', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name', 255);
                $table->string('code', 255);
                $table->integer('division_id')->unsigned();
                $table->foreign('division_id')->references('id')->on('accdivisions');
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
        Schema::drop('accfunctions');
    }
}