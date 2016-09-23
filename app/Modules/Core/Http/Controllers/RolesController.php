<?php

namespace App\Modules\Core\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Core\Models\Role;
use App\Modules\Core\Models\Permission;

class RolesController extends Controller
{
    public function roles()
    {
        $roles = Role::all();
        return view('core::roles', ['roles' => $roles]);
    }


    public function newRole(Request $request)
    {
        $add = Role::firstOrCreate(['name' => $request->input('rolename'), 'display_name' => $request->input('roledisplayname'), 'description' => $request->input('roledescription')]);
        return $this->roles()->with('success', 'Role Added!');
    }
    
    public function userRoleAssignment()
    {
        $users = \App\Modules\Core\Models\Users::all();
        $roles = Role::all();
        return view('core::assignrole', ['users' => $users, 'roles' => $roles]);
    }
    
    public function assignUserRole(Request $request)
    {
        $user = \App\Modules\Core\Models\Users::where('id', $request->input('user'))->first();
        try{
            $user->attachRole($request->input('role'));
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->userRoleAssignment()->with('error', 'Could not assign user to role');
        }
        
        
        return $this->userRoleAssignment()->with('success', 'User assigned to role');
    }
    
    public function deAssignUserRole(Request $request)
    {
        $user = \App\Modules\Core\Models\Users::where('id', $request->input('userid'))->first();
        try{
            $user->detachRole($request->input('roleid'));
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->userRoleAssignment()->with('error', 'Could not detach user from the role');
        }
        
        return $this->userRoleAssignment()->with('success', 'User detached from role');
    }
    
    public function userRoles(Request $request)
    {
        if(request()->ajax()){
            //$assignedroles = 
        }
    }
}
