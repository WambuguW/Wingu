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

Route::group(['prefix' => 'exams', 'middleware' => ['auth', 'exams']], function() {
	Route::get('/', function() {
		dd('This is the Exams module index page.');
	});
        
    //------------------------------------------------EXAMS MODULE ROUTES---------------------------------------//
    Route::get('entry', 'ExamsentryController@marksentry');
    Route::post('entry', 'ExamsentryController@saveresults');
    Route::post('entry/bulk', 'ExamsentryController@file_upload_results');
    Route::get('entry/bulk', 'ExamsentryController@marksentry');
    
    Route::get('viewresults', 'ResultsController@viewresults');
    Route::post('viewresults', 'ResultsController@viewclassresults');
    Route::get('individualresults', 'ResultsController@individualresults');
    Route::post('individualresults', 'ResultsController@show_individual_results');
    Route::post('individualresults/next', 'ResultsController@show_individual_results');
    
    Route::get('classes/selected', 'ResultsController@classstudents');
});
