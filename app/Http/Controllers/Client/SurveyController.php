<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\{Survey, Form, Sib, Plan};
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
            'survey_type' => ['required', 'integer'],
            'client_name' => ['required', 'string', 'max:255'], 
            'client_address' => ['required', 'string', 'max:255'], 
            'client_phone' => ['required', 'string', 'max:17'],

            'seller_name' => ['required', 'string', 'max:255'], 
            'seller_address' => ['required', 'string', 'max:255'], 
            'seller_phone' => ['required', 'string', 'max:17'],
 
            'layout' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors(),
            ]);
        }

        try{
            $form_id = $data['survey_type'];
            $survey = Survey::create([
                'client_name' => $data['client_name'],
                'client_address' => $data['client_address'],
                'client_phone' => $data['client_phone'],

                'seller_name' => $data['seller_name'],
                'seller_address' => $data['seller_address'],
                'seller_phone' => $data['seller_phone'],

                'form_id' => $form_id,
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
            'client_name' => ['required', 'string', 'max:255'], 
            'client_address' => ['required', 'string', 'max:255'], 
            'client_phone' => ['required', 'string', 'max:17'],

            'seller_name' => ['required', 'string', 'max:255'], 
            'seller_address' => ['required', 'string', 'max:255'], 
            'seller_phone' => ['required', 'string', 'max:17'],
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

        $agree = true === (boolean)($data['agree'] ?? false);
        if ($agree && empty($survey->plot_numbers)) {
            return response()->json([
                'status' => 0,
                'info' => 'Add plots first',
            ]);
        }

        if (empty($survey->documents)) {
            return response()->json([
                'status' => 0,
                'info' => 'Incomplete survey. Upload survey documents.',
            ]);
        }

        $completed = true === (boolean)($data['completed'] ?? false);
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
            $survey->client_name = $data['client_name'] ?? null;
            $survey->client_address = $data['client_address'] ?? null;
            $survey->client_phone = $data['client_phone'] ?? null;

            $survey->seller_phone = $data['seller_phone'] ?? null;
            $survey->seller_address = $data['seller_address'] ?? null;
            $survey->seller_name = $data['seller_name'] ?? null;
                
            $survey->status = $completed ? 'completed' : 'incomplete';
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

    public function agree($id = 0)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'agree' => ['required']
        ], ['agree.required' => 'You have to agree to our terms and conditions.']);

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

        $agree = true === (boolean)($data['agree'] ?? false);
        if ($agree && empty($survey->plot_numbers)) {
            return response()->json([
                'status' => 0,
                'info' => 'Add plots first',
            ]);
        }

        if (empty($survey->documents)) {
            return response()->json([
                'status' => 0,
                'info' => 'Incomplete survey. Upload survey documents.',
            ]);
        }

        if ($agree && empty($survey->documents->count())) {
            return response()->json([
                'status' => 0,
                'info' => 'Incomplete survey. Upload survey documents.',
            ]);
        }

        try{
            $survey->status = 'incomplete';
            $survey->completed = false;
            $survey->agree = $agree;
            $survey->approved = false;

            if($survey->update()){
                if(empty($survey->sib)){
                    $last = Plan::latest()->first();
                    $plan = Plan::create([
                        'plan_number' => empty($last->plan_number) ? 1 :  $last->plan_number + 1,
                        'year' => now()->year
                    ]);

                    Sib::create([
                        'client_id' => auth()->user()->client->id,
                        'survey_id' => $survey->id,
                        'form_id' => Form::where(['code' => 'SIB'])->pluck('id')->toArray()[0],
                        'plot_numbers' => $survey->plot_numbers,
                        'layout_id' => $survey->layout_id,
                        'plan_id' => $plan->id,
                    ]);
                }

                return response()->json([
                    'status' => 1,
                    'info' => 'Survey updated successfully.',
                    'redirect' => route('client.survey.summary', ['id' => $survey->id])
                ]);
            }

            return response()->json([
                'status' => 0,
                'info' => 'Operation failed. Try again.'
            ]);
        }catch(Exception $exception) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ]);
        }
    }

    public function summary($id = 0)
    {
        return view('client.survey.summary', ['title' => 'Survey or Lifting Application Summary', 'survey' => Survey::find($id)]);
    }

}
