<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeepaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('feepayment')) {
		
	} else{
            Schema::create('feepayment', function(Blueprint $table) {
                $table->increments('id');
                $table->integer('admno');
                $table->foreign('admno')->references('admno')->on('studentdetails');
                $table->string('receiptno', 50);
                $table->string('systemno', 50);
                $table->unsignedInteger('bank_id');
                $table->foreign('bank_id')->references('id')->on('banks');
                $table->integer('term');
                $table->integer('year');
                $table->unsignedInteger('account_id');
                $table->foreign('account_id')->references('id')->on('accounts');
                $table->integer('amount');
                $table->date('paid_on');
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
        Schema::drop('feepayment');
    }
}