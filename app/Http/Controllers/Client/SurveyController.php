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
    public function add($client_id = 0)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'client_name' => ['required', 'string', 'max:255'], 
            'client_address' => ['required', 'string', 'max:255'], 
            'client_phone' => ['required', 'string', 'max:17'],

            'seller_name' => ['required', 'string', 'max:255'], 
            'seller_address' => ['required', 'string', 'max:255'], 
            'seller_phone' => ['required', 'string', 'max:17'],
 
            'layout' => ['required', 'integer'],
            'survey' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors(),
            ]);
        }

        // try{
            $survey = Survey::create([
                'client_name' => $data['client_name'] ?? null,
                'client_address' => $data['client_address'] ?? null,
                'client_phone' => $data['client_phone'] ?? null,

                'seller_name' => $data['seller_name'] ?? null,
                'seller_address' => $data['seller_address'] ?? null,
                'seller_phone' => $data['seller_phone'] ?? null,

                'form_id' => $data['survey'],
                'layout_id' => $data['layout'],
                'completed' => false,
                'client_id' => auth()->user()->client->id,
                'status' => 'incomplete',
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
                'redirect' => route('client.survey.edit', ['id' => $survey->id])
            ]);
        // }catch(Exception $exception) {
        //     return response()->json([
        //         'status' => 0,
        //         'info' => 'Unknown error. Try again.'
        //     ]);
        // } 
    }

    public function edit($id = 0)
    {
        return view('client.survey.edit', ['title' => 'Edit Survey or Lifting Application', 'survey' => Survey::find($id)]);
    }

    public function save($id = 0)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'client_name' => ['required', 'string', 'max:255'], 
            'client_address' => ['required', 'string', 'max:255'], 
            'client_phone' => ['required', 'string', 'max:17'],

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

        $completed = true === (boolean)($data['completed'] ?? 0);
        if ($completed && empty($survey->plot_numbers)) {
            return response()->json([
                'status' => 0,
                'info' => 'Add plots first',
            ]);
        }

        if ($completed && empty($survey->documents->count())) {
            return response()->json([
                'status' => 0,
                'info' => 'Incomplete survey. Upload survey documents.',
            ]);
        }

        if ($completed && empty($survey->payment)) {
            return response()->json([
                'status' => 0,
                'info' => 'Incomplete survey. No payment.',
            ]);
        }

        if ($completed && $survey->payment->status !== 'paid') {
            return response()->json([
                'status' => 0,
                'info' => 'Incomplete application. Invalid payment',
            ]);
        }

        try{
            $survey->approval_name = $data['approval_name'] ?? null;
            $survey->approval_comments = $data['approval_comments'] ?? null;
            $survey->approval_address = $data['approval_address'] ?? null;

            $survey->client_name = $data['client_name'] ?? null;
            $survey->client_address = $data['client_address'] ?? null;
            $survey->client_phone = $data['client_phone'] ?? null;

            $survey->seller_phone = $data['seller_phone'] ?? null;
            $survey->seller_address = $data['seller_address'] ?? null;
            $survey->seller_name = $data['seller_name'] ?? null;
            $survey->status = $completed ? 'completed' : 'incomplete';
            $survey->completed = $completed;
            $survey->approved = false;

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

    public function apply()
    {
        return view('client.survey.apply', ['title' => 'Apply for Survey or Lifting']);
    }

}
