<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('expenses')) {
		
	} else{
            Schema::create('expenses', function(Blueprint $table) {
                $table->increments('id');
                $table->string('paid_to', 255);
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
        Schema::drop('expenses');
    }
}