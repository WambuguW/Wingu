<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('incomes')) {
		
	} else{
            Schema::create('incomes', function(Blueprint $table) {
                $table->increments('id');
                $table->string('paid_by', 255);
                $table->string('receiptno', 255);
                $table->integer('account_id')->unsigned();
                $table->foreign('account_id')->references('id')->on('accounts');
                $table->integer('term');
                $table->integer('year');
                $table->integer('amount');
                $table->integer('bank_id')->unsigned();
                $table->foreign('bank_id')->references('id')->on('banks');
                $table->string('description');
                $table->date('date');
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
        Schema::drop('incomes');
    }
}