<?php

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the module.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['prefix' => 'finance', 'middleware' => ['auth', 'accounts']], function() {
    Route::get('/', function() {
            dd('This is the Finance module index page.');
    });
        
            //===================================================FINANCE ROUTES=========================================//
    Route::get('feepayment', 'FeesController@payform');
    Route::get('getname{name}', function($name){

    });
    //Route::post('finance/feepayment', 'FinanceController@payfees');
    Route::post('feepayment', 'FeesController@post_student_fees');

//    Route::get('payout', 'FinanceController@payoutform');
//    Route::post('payout', 'FinanceController@payout');
    Route::get('payreceipt', function(){
        return View::make('finance::finance.feereceipt');
    });

    Route::get('studentselect', function(){
      $input = Input::get('option');
            $std = Studentdetails::find($input);
            $models = $std->models();
            return Response::eloquent($models->get(['id','name']));
    });
    
    Route::get('setfees', 'FeesController@set_fees');
    Route::post('setfees', 'FeesController@set_semester_fees');
    Route::get('feestructure', 'FeesController@fee_structure');
    Route::post('feestructure', 'FeesController@show_fee_structure');
    Route::get('reports/paid', 'FeesCOntroller@fees_paid');
    Route::post('reports/paid', 'FeesCOntroller@view_fees_paid');
    Route::get('reports/balances', 'FeesController@fee_balances');
    Route::post('reports/balances', 'FeesController@show_fee_balances');
    
    Route::get('accounts', 'AccountingController@accounts');
    Route::post('accounts', 'AccountingController@new_accounts');
    Route::post('accounts/functions', 'AccountingController@new_accounts_functions');
    Route::post('accounts/types', 'AccountingController@new_accounts_types');
    Route::get('accounts/statement', 'AccountingController@account_statement');
    
    Route::post('accounts/invoice', 'FeesController@invoice_fees');
    
    Route::get('accounts/statement/{num}' , 'AccountingController@account_statement');
    Route::get('cashflow', 'AccountingController@cashflow');
    Route::post('incomes', 'AccountingController@add_income');
    Route::post('expenses', 'AccountingController@add_expense');
    
    Route::get('reports/incomesexpense', 'AccountingController@incomesexpenses');
    
    Route::post('reports/accounts/incomes', 'AccountingController@incomesexpenses');
    Route::post('reports/accounts/expenses', 'AccountingController@incomesexpenses');
    


    //---------------------------------------------SEARCH ROUTES----------------------------------------//
    Route::get('search', function(){
        $admno = Input::get('admno');
        $stud = Studentdetails::where('admno', '=', $admno)->first();
        return Response::json($stud, 200);
    });
});
