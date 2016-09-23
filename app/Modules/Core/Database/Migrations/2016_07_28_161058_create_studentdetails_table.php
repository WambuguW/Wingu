<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if(Schema::hasTable('studentdetails')){
		
		} else{
        Schema::create('studentdetails', function(Blueprint $table) {
                //$table->integer('id')->unsigned();
                $table->primary('admno', 10);
                $table->string('fname', 255)->nullable();
                $table->string('lname', 255)->nullable();
                $table->string('surname', 255)->nullable();
                $table->string('contact', 100)->nullable();
                $table->string('address', 10)->nullable();
                $table->string('dob', 255)->nullable();
                $table->string('sex', 255)->nullable();
                $table->integer('dormitory', false, false)->nullable();
                $table->integer('classofadm')->unsigned();
                $table->foreign('classofadm')->references('id')->on('classes')->nullable();
                $table->integer('currentclass')->unsigned();
                $table->foreign('currentclass')->references('id')->on('classes')->nullable();
                $table->integer('year');
                $table->integer('stream')->unsigned();
                $table->foreign('stream')->references('id')->on('streams')->nullable();
                $table->string('admdate', 255)->nullable();
                $table->string('photo', 13)->nullable();
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
        Schema::drop('studentdetails');
    }
}