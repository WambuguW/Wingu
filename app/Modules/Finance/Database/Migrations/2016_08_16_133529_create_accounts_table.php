<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('accounts')) {
		
	} else{
            Schema::create('accounts', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name', 255);
                $table->string('accode', 255);
                $table->integer('division_id')->unsigned();
                $table->foreign('division_id')->references('id')->on('accdivisions');
                $table->integer('function_id')->unsigned();
                $table->foreign('function_id')->references('id')->on('accfunctions');
                $table->integer('type_id')->unsigned();
                $table->foreign('type_id')->references('id')->on('acctypes');
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
        Schema::drop('accounts');
    }
}