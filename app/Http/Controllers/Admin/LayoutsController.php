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
        $query = request()->get('search');
        $layouts = empty($query) ? Layout::latest()->paginate(20) : Layout::search(['name', 'address'], $query)->paginate(24);
        return view('admin.layouts.index', ['title' => 'All Layouts', 'layouts' => $layouts]);
    }

    //
    public function add()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'name' => ['required', 'string'], 
            'description' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        if(!empty(Layout::where(['name' => $data['name']])->first())) {
            return response()->json([
                'status' => 0,
                'info' => 'Layout already exists',
            ]);
        }

        $layout = Layout::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'address' => $data['address'] ?? null,
        ]);

        if (empty($layout)) {
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
        if (empty($layout)) {
            return view('admin.layouts.layout', ['title' => 'Invalid Layout', 'plots' => '', 'layout' => '']);
        }

        return view('admin.layouts.layout', ['title' => ucwords($layout->name), 'plots' => $layout->plots()->latest()->paginate(32), 'layout' => $layout]);
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

    //
    public function search()
    {
        $query = request()->get('search');
        $layouts = Layout::search(['name', 'address'], $query)->paginate(24);
        return view('admin.layouts.search', ['title' => 'Search Layouts', 'layouts' => $layouts]);
    }
}
