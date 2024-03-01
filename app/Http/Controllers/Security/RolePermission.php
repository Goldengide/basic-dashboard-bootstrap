<?php

namespace App\Http\Controllers\Security;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;


class RolePermission extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::get();
        $permissions = Permission::get();
        return view('role-permission.permissions', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        //code here
        $permissions = $request->input('permission');
        
        DB::table('role_has_permissions')->truncate();

    
        foreach ($permissions as $permission => $roles) {
            $permissionModel = Permission::where('name', $permission)->first();

            foreach ($roles as $role) {
                $roleModel = Role::where('name', $role)->first();
                
                if ($roleModel && $permissionModel) {
                    // Check if the role already has the permission
                    if (!$roleModel->hasPermissionTo($permissionModel)) {
                        $roleModel->givePermissionTo($permissionModel); // Add new permission
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Role permissions saved successfully.');
    }
}
