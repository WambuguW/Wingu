<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcctypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('acctypes')) {
		
	} else{
            Schema::create('acctypes', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name', 255);
                $table->string('description', 255);
                $table->integer('function_id')->unsigned();
                $table->foreign('function_id')->references('id')->on('accfunctions');
                $table->integer('division_id')->unsigned();
                $table->foreign('division_id')->references('id')->on('accdivisions');
                $table->string('code', 255);
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
        Schema::drop('acctypes');
    }
}