<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('invoices')) {
		
	} else{
            Schema::create('invoices', function(Blueprint $table) {
                $table->increments('id');
                $table->integer('admno');
                $table->foreign('admno')->references('admno')->on('studentdetails');
                $table->string('invoice_no');
                $table->date('invoice_date');
                $table->string('description', 255);
                $table->integer('invoice_amount');
                $table->integer('year');
                $table->integer('term');
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
        Schema::drop('invoices');
    }
}