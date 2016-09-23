<?php

namespace App\Modules\Core\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Core\Models\Role;
use App\Modules\Core\Models\Permission;

class AuthorizationController extends Controller
{
    public function assignment()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('core::assignpermission', ['permissions' => $permissions, 'roles' => $roles]);
    }
    
    public function newAssignment(Request $request)
    {
        $role = Role::find($request->input('role'));
        $ids = $request->input('permissions');
        foreach($ids as $permission_id){
            $role->attachPermission($permission_id);
        }
        return $this->assignment()->with('success', 'Permissions assigned!');
    }
}
