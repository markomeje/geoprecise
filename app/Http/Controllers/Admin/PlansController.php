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
        return view('admin.plans.index', ['title' => 'All Plans', 'plans' => Plan::latest()->paginate(21)]);
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
            'address' => $data['address'] ?? null,
            'plan_numbers' => '',
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
        return view('admin.plans.edit', ['title' => 'Edit Plan', 'plan' => Plan::find($id)]);
    }

    //
    public function save($id = 0)
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

        $plan = Plan::find($id);
        if (empty($plan)) {
            return response()->json([
                'status' => 0,
                'info' => 'An error occured. Try again later.',
            ]);
        }

        $plan->client_name = $data['client_name'];
        $plan->plan_number = $data['plan_number'];
        $plan->layout_id = $data['layout'];

        if ($plan->update()) {
            return response()->json([
                'status' => 1,
                'info' => 'Plan updated. Please wait . . .',
                'redirect' => '',
            ]);
        }

        return response()->json([
            'status' => 0,
            'info' => 'Unknown error. Try again later',
        ]);
    }

}
