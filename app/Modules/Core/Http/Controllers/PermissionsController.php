<?php

namespace App\Modules\Core\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Core\Models\Role;
use App\Modules\Core\Models\Permission;

class PermissionsController extends Controller
{
    public function permissions()
    {
        $permissions = Permission::all();
        return view('core::permissions', ['permissions' => $permissions]);
    }


    public function newPermission(Request $request)
    {
        $add = Permission::firstOrCreate(['name' => $request->input('permissionname'), 'display_name' => $request->input('permissiondisplayname'), 'description' => $request->input('permissiondescription')]);
        return $this->permissions()->with('success', 'Permission Added!');
    }
}
