<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Layout;
use Validator;

class LayoutsController extends Controller
{
    //
    public function index()
    {
        return view('admin.layouts.index', ['title' => 'All Layouts', 'layouts' => Layout::paginate(20)]);
    }

    //
    public function add()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'name' => ['required', 'string'], 
            'description' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $client = auth()->user()->client;
        if (empty($client)) {
            return response()->json([
                'status' => 0,
                'info' => 'An error occured. Try again later.',
            ]);
        }

        $Layout = Layout::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
        ]);

        if (empty($Layout)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again later',
            ]);
        }

        return response()->json([
            'status' => 1,
            'info' => 'Layout added. Please wait . . .',
            'redirect' => '',
        ]);
    }

    //
    public function edit($id = 0)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'name' => ['required', 'string'], 
            'address' => ['nullable', 'string'],
            'status' => ['nullable', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $Layout = Layout::find($id);
        if (empty($Layout)) {
            return response()->json([
                'status' => 0,
                'info' => 'An error occured. Try again later.',
            ]);
        }

        $Layout->name = $data['name'];
        $Layout->active = (boolean)($data['status'] ?? 0);
        $Layout->address = $data['address'] ?? null;
        if ($Layout->update()) {
            return response()->json([
                'status' => 1,
                'info' => 'Layout updated. Please wait . . .',
                'redirect' => '',
            ]);
        }

        return response()->json([
            'status' => 0,
            'info' => 'Unknown error. Try again later',
        ]);
    }

    //
    public function layout($id)
    {
        $layout = Layout::find($id);
        if (empty($layout) || empty($layout->plots->count())) {
            return view('admin.layouts.layout', ['title' => 'Invalid Layout', 'plots' => '', 'layout' => '']);
        }

        return view('admin.layouts.layout', ['title' => ucwords($layout->name), 'plots' => $layout->plots->paginate(32), 'layout' => $layout]);
    }

    public function status($id = 0)
    {
        $layout = Layout::find($id);
        if (empty($layout)) {
            return response()->json([
                'status' => 0,
                'info' => 'Layout not found.',
            ]);
        }

        $status = (boolean)$layout->active;
        $layout->active = !$status;
        if ($layout->update()) {
            return response()->json([
                'status' => 1,
                'info' => 'Operation successful.',
                'redirect' => ''
            ]);
        }

        return response()->json([
            'status' => 0,
            'info' => 'Unknown error. Try again.',
        ]);
    }

    public function delete($id = 0)
    {
        $layout = Layout::find($id);
        if (empty($layout)) {
            return response()->json([
                'status' => 0,
                'info' => 'Layout not found.',
            ]);
        }

        if($layout->plots()->exists()) {
            return response()->json([
                'status' => 0,
                'info' => 'Layout is already in use.',
            ]);
        }

        if ($layout->delete()) {
            return response()->json([
                'status' => 1,
                'info' => 'Operation successful.',
                'redirect' => ''
            ]);
        }

        return response()->json([
            'status' => 0,
            'info' => 'Unknown error. Try again.',
        ]);
    }
}
