<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('banks')) {
		
	} else{
            Schema::create('banks', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name', 255);
                $table->string('accno', 255);
                $table->string('branch', 255);
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
        Schema::drop('banks');
    }
}