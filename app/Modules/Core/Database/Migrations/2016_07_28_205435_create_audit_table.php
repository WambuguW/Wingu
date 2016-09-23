<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if(Schema::hasTable('audit')){
		
		} else{
        Schema::create('audit', function(Blueprint $table) {
                    $table->increments('id');
                    $table->unsignedInteger('userid');
                    $table->foreign('userid')->references('id')->on('users');
                    $table->string('action', 255);
                    $table->string('date', 255);
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
        Schema::drop('audit');
    }
}