<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if(Schema::hasTable('examresults')){
		
		} else{
        Schema::create('examresults', function(Blueprint $table) {
                $table->integer('id');
                $table->integer('admno');
                $table->primary(['id', 'admno']);
                $table->foreign('admno')->references('admno')->on('studentdetails');
                $table->integer('class')->unsigned();
                $table->foreign('class')->references('id')->on('classes');
                $table->integer('exam')->unsigned();
                $table->foreign('exam')->references('id')->on('examtypes');
                $table->string('term', 255);
                $table->string('year', 255);
                $table->integer('subjectid')->unsigned();
                $table->foreign('subjectid')->references('id')->on('subjects');
                $table->string('marks', 255);
                $table->string('comments', 255);
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
        Schema::drop('examresults');
    }
}