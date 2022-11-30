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
    public function set($role_id)
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
            $permissions['resource'][] = $resource;
            $permissions['action'][] = $action;
            // $permissions[] = $permissions;
        }

        
        dd($permissions);
        // Permission::create([
        //     'resource' => $data['resource'], 
        //     'permission' => $data['permission'], 
        //     'staff_id' => $data['staff_id'],
        //     'description' => 'No description',
        // ]);

        // return response()->json([
        //     'status' => 1, 
        //     'info' => 'Operation successful.',
        //     'redirect' => ''
        // ]); 

        // return response()->json([
        //     'status' => 1, 
        //     'info' => 'Operation successful.',
        //     'redirect' => ''
        // ]); 
    }

}