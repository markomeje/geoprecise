<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Plot, Client, Survey, Form};
use Validator;

class SurveysController extends Controller
{
    //
    public function index($limit = 20)
    {
        return view('admin.surveys.index', ['title' => 'All Surveys', 'surveys' => Survey::latest()->paginate($limit)]);
    }

    //
    public function add($client_id = 0)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'purchaser_name' => ['required', 'string', 'max:255'], 
            'purchaser_address' => ['required', 'string', 'max:255'], 
            'purchaser_phone' => ['required', 'string', 'max:17'],

            'seller_name' => ['required', 'string', 'max:255'], 
            'seller_address' => ['required', 'string', 'max:255'], 
            'seller_phone' => ['required', 'string', 'max:17'],
 
            'layout' => ['required', 'integer'], 

            'name' => ['nullable', 'string', 'max:255'], 
            'comments' => ['nullable', 'string', 'max:500'], 
            'address' => ['nullable', 'string', 'max:255'], 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors(),
            ]);
        }

        try{
            $survey = Survey::create([
                'purchaser_name' => $data['purchaser_name'],
                'purchaser_address' => $data['purchaser_address'],
                'purchaser_phone' => $data['purchaser_phone'],

                'seller_name' => $data['seller_name'],
                'seller_address' => $data['seller_address'],
                'seller_phone' => $data['seller_phone'],

                'form_id' => Form::where(['code' => 'LES'])->pluck('id')->toArray()[0],
                'approval_name' => $data['approval_name'] ?? null,
                'approval_comments' => $data['approval_comments'] ?? null,
                'approval_address' => $data['approval_address'] ?? null,
                'staff_id' => auth()->id(),

                'layout_id' => $data['layout'],
                'completed' => false,
                'client_id' => $client_id,
                'status' => 'started',
            ]);

            if(empty($survey->id)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Operation error. Try again',
                ]);
            }

            return response()->json([
                'status' => 1,
                'info' => 'Operation successful.',
                'redirect' => route('admin.survey.edit', ['id' => $survey->id])
            ]);
        }catch(Exception $exception) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ]);
        } 
    }

    //
    public function apply($client_id = 0)
    {
        return view('admin.surveys.apply', ['title' => 'Surveying Application', 'client' => Client::where(['id' => $client_id])->first()]);
    }

    //
    public function save($id = 0)
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

        $plot = Survey::find($id);
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

    //
    public function edit($id = 0)
    {
        return view('admin.surveys.survey', ['title' => 'Edit Surveying Application', 'survey' => Survey::find($id)]);
    }
}
