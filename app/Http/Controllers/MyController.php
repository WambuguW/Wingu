<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class MyController extends Controller
{
    /**
     * Handle ajax requests on user action
     * 
     * @param \Illuminate\Http\Request $request
     * @return type
     */
    public function requestHandler(Request $request)
    {
        if($request->ajax()){
            $users = User::all();
            return response()->json($users);
        }
    }
}
