<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use Validator;

class PlansController extends Controller
{
    //
    public function index()
    {
        return view('admin.plans.index', ['title' => 'All Plans', 'plans' => Plan::latest()->paginate(20)]);
    }

    //
    public function add()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'client_name' => ['required', 'string'], 
            'plan_number' => ['required', 'string'],
            'address' => ['nullable', 'string'],
            'layout' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $plan_number = $data['plan_number'];
        if(Plan::where(['plan_number' => $plan_number])->exists()) {
            return response()->json([
                'status' => 0,
                'info' => 'Plan number already exists'
            ]);
        }

        $plan = Plan::create([
            'client_name' => $data['client_name'],
            'plan_number' => $plan_number,
            'layout_id' => $data['layout'],
            'address' => $data['address'],
            'plot_numbers' => '',
        ]);

        if (empty($plan)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again later',
            ]);
        }

        return response()->json([
            'status' => 1,
            'info' => 'Plan added',
            'redirect' => '',
        ]);
    }

    //
    public function edit($id = 0)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'name' => ['required', 'string'], 
            'description' => ['nullable', 'string'],
            'category' => ['required', 'string'],
            'layout' => ['required', 'string'],
            'number' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $plot = Plot::find($id);
        if (empty($plot)) {
            return response()->json([
                'status' => 0,
                'info' => 'An error occured. Try again later.',
            ]);
        }

        $plot->name = $data['name'];
        $plot->description = $data['description'] ?? null;
        $plot->number = $data['number'];
        $plot->category = $data['category'];
        $plot->layout_id = $data['layout'];

        if ($plot->update()) {
            return response()->json([
                'status' => 1,
                'info' => 'Plot updated. Please wait . . .',
                'redirect' => '',
            ]);
        }

        return response()->json([
            'status' => 0,
            'info' => 'Unknown error. Try again later',
        ]);
    }

}
