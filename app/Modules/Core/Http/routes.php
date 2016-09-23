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

Route::group(['prefix' => 'core', 'middleware' => 'auth'], function() {
    Route::get('/', function() {
            dd('This is the Core module index page.');
    });
    
    Route::get('dashboard', function(){
        return view('core::dashboard');
    });
    
    Route::get('admindashboard', function(){
        return view('core::admindashboard');
    });
    
    //==================================SYSTEM SETUP ROUTES========================================//
    Route::group(['middleware' => 'admin'], function(){
        
        Route::get('setup/classes', 'SetupController@classes');
        Route::post('setup/classes', 'SetupController@addclasses');
        Route::get('setup/classes/delete/{num}', 'SetupController@deleteclass');

        Route::get('setup/streams', 'SetupController@streams');
        Route::post('setup/streams', 'SetupController@addstreams');
        Route::get('setup/streams/delete/{num}', 'SetupController@deletestream');

        Route::get('setup/dorms', 'SetupController@dorms');
        Route::post('setup/dorms', 'SetupController@adddorms');
        Route::get('setup/dorms/delete/{num}', 'SetupController@deletedorm');

        Route::get('setup/subjects', 'SetupController@subjects');
        Route::post('setup/subjects', 'SetupController@addsubjects');
        Route::get('setup/subjects/delete/{num}', 'SetupController@deletesubject');

        Route::get('setup/exams', 'SetupController@exams');
        Route::post('setup/exams', 'SetupController@addexams');
        Route::get('setup/exams/delete/{num}', 'SetupController@deleteexam');

        Route::get('setup/banks', 'SetupController@banks');
        Route::post('setup/banks', 'SetupController@add_banks');
        Route::get('setup/banks/delete/{num}', 'SetupController@delete_banks');


        /*-------------------------User Accounts Routes------------------------------------------------*/
        Route::get('accounts', function(){
            return view('core::admindashboard');
        });

        Route::get('accounts/users', 'AccountsController@users');
        Route::post('accounts/users', 'AccountsController@register');
        Route::post('accounts/users/togglestatus', 'AccountsController@toggle_user_status');
        Route::get('accounts/users/delete/{num}', 'AccountsController@delete_user');
        Route::get('accounts/audit', 'AccountsController@audit_trail');


        /*--------------------------------Roles and Permissions Routes---------------------------------*/

        Route::get('accounts/roles', 'RolesController@roles');
        Route::post('accounts/roles', 'RolesController@newRole');

        Route::get('accounts/permissions', 'PermissionsController@permissions');
        Route::post('accounts/permissions', 'PermissionsController@newPermission');

        Route::get('accounts/authorization', 'AuthorizationController@assignment');
        Route::post('accounts/authorization', 'AuthorizationController@newAssignment');

        Route::get('accounts/roles/assign', 'RolesController@userRoleAssignment');
        Route::post('accounts/roles/assign', 'RolesController@assignUserRole');
        Route::post('accounts/roles/deassign', 'RolesController@deAssignUserRole');
    });

    
    /*-================================STUDENT REGISTRATION ROUTES=====================================*/
    
    Route::group(['middleware' => 'registration'], function(){
        
        Route::get('students/registration', 'StudentsController@stdregister');
        Route::post('students/registration', 'StudentsController@register');
        Route::get('students/details', function(){
            return View::make('students.details');
            });
        Route::get('students/details', 'StudentsController@getallstudents');

        Route::get('students/details/{num}', array(
            'as' => 'students', 
            'uses' => 'StudentsController@getstudent'
            ));

        Route::get('students/profile/{num}', array(
            'as' => 'students', 
            'uses' => 'StudentsController@getprofile'
            ));

        Route::get('students/profile', function(){
            return View::make('students.profile');
            });
        //Route::get('students/profile/examhistory', 'StudentsController@examhistory');

        Route::get('students/delete/{num}', 'StudentsController@deletestudent');

        Route::get('students/edit/{num}', 'StudentsController@editstudent');

        Route::post('students/edit', 'StudentsController@updatedetails');

        Route::get('students/profile/examhistory', 'StudentsController@examhistory');

        Route::get('students/nextclass', 'StudentsController@nextclass');
        Route::post('students/nextclass', 'StudentsController@selected_to_next_class');
        Route::get('students/class/students', 'StudentsController@show_class_students');
        Route::post('students/class/nextclass', 'StudentsController@alltonext');

        Route::post('students/search/dorm/gender', 'StudentsController@getdormgender');
    });
    
    
    
});
