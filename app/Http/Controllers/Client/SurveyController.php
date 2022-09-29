<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\{Survey, Form};
use Validator;
use Exception;

class SurveyController extends Controller
{

    //
    public function index($limit = 20)
    {
        $client = auth()->user()->client;
        return view('client.survey.index', ['title' => 'Surveys and Lifting Applications', 'surveys' => Survey::latest('id')->where(['client_id' => ($client->id ?? 0)])->paginate($limit)]);
    }

    //
    public function add()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'purchaser_name' => ['nullable', 'string', 'max:255'], 
            'purchaser_address' => ['nullable', 'string', 'max:255'], 
            'purchaser_phone' => ['nullable', 'string', 'max:17'],

            'seller_name' => ['nullable', 'string', 'max:255'], 
            'seller_address' => ['nullable', 'string', 'max:255'], 
            'seller_phone' => ['nullable', 'string', 'max:17'],

            'plot_numbers' => ['nullable', 'array'], 
            'layout' => ['nullable', 'integer'], 
            'document_presented' => ['nullable', 'string'],

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
            $plot_numbers = $data['plot_numbers'] ?? null;
            $plot_numbers = is_array($plot_numbers) ? implode('-', $plot_numbers) : $plot_numbers;
            $survey = Survey::create([
                'form_id' => Form::where(['code' => 'LES'])->pluck('id')->toArray()[0],
                'approval_name' => $data['approval_name'] ?? null,
                'approval_comments' => $data['approval_comments'] ?? null,
                'approval_address' => $data['approval_address'] ?? null,

                'purchaser_name' => $data['purchaser_name'] ?? null,
                'purchaser_address' => $data['purchaser_address'] ?? null,
                'purchaser_phone' => $data['purchaser_phone'] ?? null,

                'seller_phone' => $data['seller_phone'] ?? null,
                'seller_phone' => $data['seller_phone'] ?? null,
                'seller_phone' => $data['seller_phone'] ?? null,

                'layout_id' => $data['layout'] ?? null,
                'completed' => false,
                'user_id' => auth()->id(),
                'document_presented' => $data['document_presented'] ?? null,
                'status' => 'started',
            ]);

            return ($survey->id > 0) ? response()->json([
                'status' => 1,
                'info' => 'Operation successful.',
                'redirect' => route('client.survey.edit', ['id' => $survey->id])
            ]) : response()->json([
                'status' => 0,
                'info' => 'Operation error. Try again.'
            ]);
        }catch(Exception $exception) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ]);
        } 
    }

    public function edit($id = 0)
    {
        return view('client.survey.edit', ['title' => 'Edit Survey or Lifting Application', 'survey' => Survey::find($id)]);
    }

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
                'info' => 'Unknown error. Survey not found'
            ]);
        }

        $completed = empty($data['completed']) ? false : ($data['completed'] === 'yes' ? true : false);
        if ($completed && empty($survey->payment)) {
            return response()->json([
                'status' => 0,
                'info' => 'Please make payment before final submission',
            ]);
        }

        if ($completed && $survey->payment->status !== 'paid') {
            return response()->json([
                'status' => 0,
                'info' => 'Please make payment before final submission',
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
            $survey->status = 'active';
            $survey->completed = $completed;

            return $survey->update() ? response()->json([
                'status' => 1,
                'info' => 'Survey updated successfully.',
                'redirect' => ''
            ]) : response()->json([
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

}
