<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth;
use Illuminate\Auth\AuthServiceProvider;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
    /**
     * Authenticate system users
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function userlogin(Request $request)
    {
        if($this->validator($request->all())){
            if(auth()->attempt(['username' => $request->input('username'), 'password' => $request->input('password')])){
                return view('core::dashboard');                
            } else{
                return view('auth.login', ['login_error' => 'Incorrect username/ password']);
            }
        } else{
            return view('auth.login', ['form_errors' => 'Please enter the correct email address format']);
        }
        
        
    }
}
