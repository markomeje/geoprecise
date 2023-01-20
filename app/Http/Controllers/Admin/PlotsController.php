<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Plot;
use Validator;

class PlotsController extends Controller
{
    //
    public function index()
    {
        return view('admin.plots.index', ['title' => 'All Plots', 'plots' => Plot::latest()->paginate(20)]);
    }

    //
    public function add()
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

        $plot = Plot::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'category' => $data['category'],
            'layout_id' => $data['layout'],
            'number' => $data['number'],
        ]);

        if (empty($plot)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again later',
            ]);
        }

        return response()->json([
            'status' => 1,
            'info' => 'Plot added. Please wait . . .',
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
