<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Plot, Client, Survey, Form, Staff};
use Carbon\Carbon;
use Validator;
use Pdf;

class SurveysController extends Controller
{
    //
    public function index($limit = 20)
    {
        return view('admin.surveys.index', ['title' => 'All Surveys', 'surveys' => Survey::latest()->paginate($limit)]);
    }

    public function pdf($id = 0) {
        return view('admin.surveys.pdf', ['title' => 'All Surveys', 'survey' => Survey::find($id)]);
    }

    //
    public function survey($id = 0)
    {
        return view('admin.surveys.survey', ['title' => 'Survey & Lifting Application', 'survey' => Survey::find($id)]);
    }

    public function search()
    {
        $query = request()->get('search');
        $surveys = Survey::search(['client.fullname', 'seller_name', 'seller_address', 'client.phone', 'client_name', 'client_address', 'approved_by'], $query)->paginate(24);
        return view('admin.surveys.search')->with(['surveys' => $surveys]);
    }

    public function approve($id = 0)
    {
        $survey = Survey::find($id);
        if (empty($survey)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid operation'
            ]);
        }

        $payment = $survey->payment;
        if (empty($payment)) {
            return response()->json([
                'status' => 0,
                'info' => 'No payment.'
            ]);
        }

        if (true !== (boolean)$payment->approved) {
            return response()->json([
                'status' => 0,
                'info' => 'Approve payment first.'
            ]);
        }

        $survey->approved = true;
        $survey->approved_at = Carbon::now();
        $survey->approved_by = auth()->id();
        $survey->completed = true;
        if ($survey->update()) {
            return response()->json([
                'status' => 1,
                'info' => 'Operation successfull',
                'redirect' => ''
            ]);
        }

        return response()->json([
            'status' => 0,
            'info' => 'Operation failed'
        ]);
    }

    public function edit($id = 0)
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

        try{
            $survey->client_name = $data['client_name'] ?? $survey->client_name;
            $survey->client_address = $data['client_address'] ?? $survey->client_address;
            $survey->client_phone = $data['client_phone'] ?? $survey->client_phone;

            $survey->seller_phone = $data['seller_phone'] ?? $survey->seller_phone;
            $survey->seller_address = $data['seller_address'] ?? $survey->seller_address;
            $survey->seller_name = $data['seller_name'] ?? $survey->seller_name;

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
}












