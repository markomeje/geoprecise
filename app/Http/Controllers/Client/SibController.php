<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\{Sib, Form, Survey};
use Validator;
use Exception;

class SibController extends Controller
{
    //
    public function index($limit = 20)
    {
        $client = auth()->user()->client;
        return view('client.sib.index', ['title' => 'Site Inspection Bookings', 'sibs' => Sib::latest()->where(['client_id' => ($client->id ?? 0)])->paginate($limit)]);
    }

    //
    public function apply()
    {
        $data = request()->all();
        if (empty($data['survey_id'])) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid operation.',
            ]);
        }

        $survey = Survey::where(['id' => $data['survey_id']])->first();
        if (empty($survey)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Survey not found.',
            ]);
        }

        if (true !== (boolean)$survey->approved) {
            return response()->json([
                'status' => 0,
                'info' => 'Survey must be approved first.',
            ]);
        }

        try {
            $sib = Sib::create([
                'client_id' => auth()->user()->client->id,
                'survey_id' => $data['survey_id'],
                'form_id' => Form::where(['code' => 'SIB'])->pluck('id')->toArray()[0],
            ]);

            if (empty($sib->id)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Operation failed. Try again.',
                ]);
            }

            return response()->json([
                'status' => 1,
                'info' => 'Operation successful. Click ok . . .',
                'redirect' => route('client.sib.edit', ['id' => $sib->id]),
            ]);
        } catch (Exception $error) {
            return response()->json([
                'status' => 0,
                'info' => 'Operation failed. Try again'
            ]);
        }
            
    }

    //
    public function edit($id = 0)
    {
        return view('client.sib.edit', ['sib' => Sib::find($id)]);
    }

    //
    public function save($id = 0)
    {
        $data = request()->all(['completed', 'comments']);
        $sib = Sib::find($id);
        if (empty($sib)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Not found.',
            ]);
        }

        $completed = (boolean)($data['completed'] ?? 0) === true;
        if ($completed && empty($sib->payment)) {
            return response()->json([
                'status' => 0,
                'info' => 'Incomplete application. No payment.',
            ]);
        }

        if ($completed && $sib->payment->status !== 'paid') {
            return response()->json([
                'status' => 0,
                'info' => 'Incomplete application. Invalid payment',
            ]);
        }

        try{
            $sib->comments = $data['comments'] ?? '';
            $sib->completed = $completed;
            if (empty($sib->update())) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Operation failed. Try again.',
                ]);
            }

            return response()->json([
                'status' => 1,
                'info' => 'Operation successful. Please wait . . .',
                'redirect' => route('client.sib.edit', ['id' => $sib->id]),
            ]);
        }catch(Exception $exception) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ]);
        }
    }

}
