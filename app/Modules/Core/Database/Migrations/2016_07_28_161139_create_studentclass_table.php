<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentclassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if(Schema::hasTable('studentclass')){
		
		} else{
        Schema::create('studentclass', function(Blueprint $table){
                $table->increments('id');
                $table->integer('admno', false, false );
                $table->foreign('admno')->references('admno')->on('studentdetails');
                $table->integer('class')->unsigned();
                $table->foreign('class')->references('id')->on('classes');
                $table->integer('year');
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
        Schema::drop('studentclass');
    }
}