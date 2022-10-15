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
     * Admin assign permissions
     */
    public function assign()
    {
        $data = request()->only(['resource', 'permission', 'staff_id']);
        $validator = Validator::make($data, [
            'resource' => ['required'],
            'staff_id' => ['required'],
            'permission' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'info' => 'An error occured. Try again.'
            ]);
        }

        $permission = Permission::where([
            'resource' => $data['resource'], 
            'permission' => $data['permission'], 
            'staff_id' => $data['staff_id']
        ])->first();

        if (empty($permission)) {
            Permission::create([
                'resource' => $data['resource'], 
                'permission' => $data['permission'], 
                'staff_id' => $data['staff_id'],
                'description' => 'No description',
            ]);

            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful.',
                'redirect' => ''
            ]); 
        }

        $permission->staff_id = $data['staff_id'];
        $permission->permission = $data['permission'];
        $permission->resource = $data['resource'];
        $permission->update();
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful.',
            'redirect' => ''
        ]); 
    }

    /**
     * Admin assign permissions
     */
    public function remove($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful.',
            'redirect' => ''
        ]); 
    }

}