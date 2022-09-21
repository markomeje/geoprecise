<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Plot, Client, Survey, Form, Staff};
use Carbon\Carbon;
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

                'layout_id' => $data['layout'],
                'completed' => false,
                'client_id' => $client_id,
                'status' => 'incomplete',
                'recorder_type' => 'staff',
                'recorded_by' => auth()->id(),
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
            'purchaser_name' => ['required', 'string', 'max:255'], 
            'purchaser_address' => ['required', 'string', 'max:255'], 
            'purchaser_phone' => ['required', 'string', 'max:17'],

            'seller_name' => ['required', 'string', 'max:255'], 
            'seller_address' => ['required', 'string', 'max:255'], 
            'seller_phone' => ['required', 'string', 'max:17'],

            'approval_name' => ['required', 'string', 'max:255'], 
            'approval_comments' => ['required', 'string', 'max:500'], 
            'approval_address' => ['required', 'string', 'max:255'], 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors(),
            ]);
        }

        $survey = Survey::find($id);
        if (empty($survey)) {
            response()->json([
                'status' => 0,
                'info' => 'Unknown error. Survey not found.'
            ]);
        }

        $approved = (boolean)($data['approved'] ?? 0) === true;
        if ($approved && empty($survey->documents->count())) {
            return response()->json([
                'status' => 0,
                'info' => 'Incomplete survey. Upload survey documents.',
            ]);
        }

        if ($approved && empty($survey->payment)) {
            return response()->json([
                'status' => 0,
                'info' => 'Incomplete survey. No payment.',
            ]);
        }

        if ($approved && $survey->payment->status !== 'paid') {
            return response()->json([
                'status' => 0,
                'info' => 'Incomplete application. Invalid payment',
            ]);
        }

        if ($approved && (boolean)$survey->payment->approved !== true) {
            return response()->json([
                'status' => 0,
                'info' => 'Please approved payment first.',
            ]);
        }

        try{
            $survey->approval_name = $data['approval_name'] ?? null;
            $survey->approval_comments = $data['approval_comments'] ?? null;
            $survey->approval_address = $data['approval_address'] ?? null;

            $survey->purchaser_name = $data['purchaser_name'] ?? null;
            $survey->purchaser_address = $data['purchaser_address'] ?? null;
            $survey->purchaser_phone = $data['purchaser_phone'] ?? null;

            $survey->seller_phone = $data['seller_phone'] ?? null;
            $survey->seller_address = $data['seller_address'] ?? null;
            $survey->seller_name = $data['seller_name'] ?? null;
            $survey->approved = $approved;
            $survey->status = $approved ? 'completed' : 'incomplete';
            $survey->completed = $approved;

            if ($approved) {
                $survey->approved_by = auth()->id();
                $survey->approved_at = Carbon::now();
            }

            if($survey->update()){
                return response()->json([
                    'status' => 1,
                    'info' => 'Survey updated successfully.',
                    'redirect' => ''
                ]);
            }

            return response()->json([
                'status' => 0,
                'info' => 'Update failed. Try again.'
            ]);
        }catch(Exception $exception) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ]);
        }
    }

    //
    public function edit($id = 0)
    {
        return view('admin.surveys.edit', ['title' => 'Edit Surveying Application', 'survey' => Survey::find($id)]);
    }
}
