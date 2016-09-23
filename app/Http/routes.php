<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    //return view('auth.login');
    if(auth()->check()){
        return redirect()->to('core/dashboard');
    }
    return view('auth.login');
});

Route::post('/', 'Auth\AuthController@userLogin');

/*
 * Users must be logged in to make these requests
 */
Route::group(['middleware' => 'auth'], function(){
    Route::get('/user/dashboard', function(){
        return view('dashboard');
    });
    
    Route::get('/logout', function(){
        auth()->logout();
        return redirect('/');
    });
    
});
