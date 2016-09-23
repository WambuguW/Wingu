<?php

namespace App\Modules\Core\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Modules\Core\Models\Role;

class AccountsController extends Controller
{
    /**
     * Register a new user to the application
     * 
     * @param \Illuminate\Http\Request $request
     * @return type
     */
    public function register(Request $request)
    {
//        $pass = str_shuffle('ABCDEFTUVWXYZ23456789ghjklmnpqrs');
//        $password = substr($pass, 0, 8);
        $password = $request->input('newuser');
        $success = 'Account Created Successfully';
        
            $user = \App\User::firstOrCreate(['name' => $request->input('newuser'), 'username' => $request->input('newuser'), 'email' => $request->input('email'), 'password' => Hash::make($password), 'role' => $request->input('userrole'), 'active' => $request->input('userstatus')]);
            $users = \App\User::all();
            return response()->json($users);
    }
    
    /**
     * Delete the user whose ID matches the one supplied
     * 
     * @param type $id
     * @return type
     */
    
    public function delete_user($id)
    {
        if(\App\User::where('id', '=', $id)->delete()){
            
            $action = "Deleted user id: " . $id;
            \App\Modules\Core\Helpers\UserAccounts::system_audit(auth()->user()->id, $action);
            
            return $this->users()->with('success', 'User deleted');
        }
        else{
            return $this->users()->with('error', 'Failed to delete User');
        }
    }
    
    /**
     * Toggle the user account status. Account can either be active or suspended
     * 
     * @param \Illuminate\Http\Request $request
     * @return type
     */
    public function toggle_user_status(Request $request) 
    {
        $id = $request->input('userid');
        if (request()->ajax()) {
            $currstatus = \App\User::where('id', '=', $id)->first();
            if ($currstatus->status == 'Active') {
                if (\App\User::where('id', '=', $id)->update(array('status' => 'Suspended'))) {
                    return response()->json("OK");
                }
            } else if ($currstatus->status == 'Suspended') {
                if (\App\User::where('id', '=', $id)->update(array('status' => 'Active'))) {
                    return response()->json("OK");
                }
            } else {//status was not set, set it to active
                if (\App\User::where('id', '=', $id)->update(array('status' => 'Active'))) {
                    return response()->json("OK");
                }
            }
        }
    }
    
    public function users()
    {
        $users = \App\User::all();
        $roles = Role::all();
        return view('core::users', ['sys_users' => $users, 'roles' => $roles]);
    }
    
    public function audit_trail()
    {
        \App\Modules\Core\Helpers\UserAccounts::audit_trail();
    }

}
