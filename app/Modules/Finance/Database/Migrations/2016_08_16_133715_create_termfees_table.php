<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermfeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('termfees')) {
		
	} else{
            Schema::create('termfees', function(Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('class');
                $table->foreign('class')->references('id')->on('classes');
                $table->integer('term');
                $table->integer('year');
                $table->unsignedInteger('account_id');
                $table->foreign('account_id')->references('id')->on('accounts');
                $table->integer('amount');
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
        Schema::drop('termfees');
    }
}