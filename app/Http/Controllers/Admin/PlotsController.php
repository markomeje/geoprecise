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
            'category' => ['required', 'string'],
            'layout' => ['required', 'string'],
            'minimum_plot_number' => ['required', 'string'],
            'maximum_plot_number' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        if ($data['minimum_plot_number'] > $data['maximum_plot_number']) {
            return response()->json([
                'status' => 0,
                'info' => 'Minimum plot number must be less than maximum plot number',
            ]);
        }

        $categories = Plot::CATEGORIES;
        $category = $data['category'] ?? '';
        for ($i = $data['minimum_plot_number']; $i  <= $data['maximum_plot_number']; $i ++) { 
            Plot::create([
                'name' => '-',
                'description' => null,
                'category' => $category,
                'layout_id' => $data['layout'],
                'number' => empty($categories[$category]) ? $i : $categories[$category].'/'.$i,
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

        $plot->name = '-';
        $plot->description = null;
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
