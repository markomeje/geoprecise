<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\{Sib, Form, Survey, Plan};
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
        $validator = Validator::make($data, [
            'plan_number' => ['required'],
            'year' => ['required'],
            'layout' => ['nullable', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $plan = Plan::where([
            'plan_number' => $data['plan_number'], 
            'year' => $data['year']
        ])->first();

        if (empty($plan)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid plan number',
            ]);
        }

        try {
            $sib = Sib::create([
                'client_id' => auth()->user()->client->id,
                'plan_id' => $plan->id,
                'form_id' => Form::where(['code' => 'SIB'])->pluck('id')->toArray()[0],
                'layout_id' => $data['layout'] ?: null
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
        $data = request()->all();
        $validator = Validator::make($data, [
            'phone' => ['required'],
            'location' => ['required', 'string'],
            'comments' => ['nullable', 'string'],
            'agree' => ['required'],
        ], ['agree.required' => 'You have to agree to our terms and conditions']);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $sib = Sib::find($id);
        if (empty($sib)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Not found.',
            ]);
        }

        $completed = true === (boolean)($data['agree'] ?? false);

        try{
            $sib->comments = $data['comments'] ?? '';
            $sib->phone = $data['phone'];
            $sib->location = $data['location'];
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
