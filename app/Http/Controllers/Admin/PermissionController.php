<?php

namespace App\Http\Controllers\Admin;
use App\Models\{Permission, User};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Validator;


class PermissionController extends Controller
{
    /**
     * Admin set for role
     */
    public function set($role_id = 0)
    {
        $permission = request()->post('permission');
        if (empty($permission) || !is_array($permission)) {
            return response()->json([
                'status' => 0, 
                'info' => 'No permissions set for this role.'
            ]);
        }

        $permissions = [];
        foreach ($permission as $function) {
            if(!str_contains($function, '|')) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Invalid Operation'
                ]);
            }

            $function = explode('|', $function);
            [$resource, $action] = $function;
            $permissions[] = ['resource' => $resource, 'action' => $action, 'role_id' => $role_id];
        }

        Permission::where([
            'role_id' => $role_id
        ])->delete();
        
        if (!empty($permissions)) {
            foreach ($permissions as $permission) {
                Permission::create($permission);
            }
        }
        
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful.',
            'redirect' => ''
        ]); 
    }

}


















