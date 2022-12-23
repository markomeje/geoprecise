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
        return view('admin.plans.index', ['title' => 'All Plans', 'plans' => Plan::latest('id')->paginate(28)]);
    }

    //
    public function add()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'plan_number' => ['required', 'string'],
            'year' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $year = $data['year'];
        $plan_number = $data['plan_number'];
        if(Plan::where(['plan_number' => $plan_number, 'year' => $year])->exists()) {
            return response()->json([
                'status' => 0,
                'info' => 'Plan number already exists'
            ]);
        }

        $plan = Plan::create([
            'plan_number' => $plan_number,
            'layout_id' => $data['layout'] ?? null,
            'year' => $year
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
            'plan_number' => ['required', 'string'],
            'year' => ['required', 'string'],
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

        $plan->year = $data['year'];
        $plan->plan_number = $data['plan_number'];
        $plan->layout_id = $data['layout'] ?? null;

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
