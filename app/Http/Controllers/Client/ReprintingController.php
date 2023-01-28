<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\{Plan, Reprinting, Form};
use App\Paystack;
use Validator;
use Exception;

class ReprintingController extends Controller
{
    //
    public function index()
    {
        $client = auth()->user()->client;
        $reprinting = Reprinting::latest('created_at')->where(['client_id' => $client->id ?? 0])->get();
        return view('client.reprinting.index', ['reprinting' => $reprinting]);
    }

    //
    public function apply()
    {
        $data = request()->all(['plan_number', 'year', 'layout']);
        $validator = Validator::make($data, [
            'plan_number' => ['required', 'string'],
            'year' => ['required', 'string'], 
            'layout' => ['required', 'string'], 
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

        $form = Form::where(['code' => 'APP'])->pluck('id')->toArray();
        if(empty($form)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid Operation. Report this issue to us.',
            ]);
        }
            

        try {
            $reprint = Reprinting::create([
                'client_id' => auth()->user()->client->id,
                'plan_id' => $plan->id,
                'form_id' => $form[0],
                'layout_id' => $data['layout']
            ]);

            if (empty($reprint->id)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Operation failed. Try again.',
                ]);
            }

            return response()->json([
                'status' => 1,
                'info' => 'Operation successful. Click ok . . .',
                'redirect' => route('client.reprinting.edit', ['id' => $reprint->id]),
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
        $reprinting = Reprinting::find($id);
        // dd($reprinting);
        return view('client.reprinting.edit', ['reprinting' => $reprinting]);
    }

    //
    public function save($id = 0)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'plot_number' => ['required', 'string'],
            'total_copies' => ['required', 'string'],
            'agree' => ['required'],
        ], ['agree.required' => 'You have to agree to our terms and conditions.']);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        try {
            $reprinting = Reprinting::find($id);
            if (empty($reprinting)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Invalid Operation. Try again.',
                ]);
            }
        
            $reprinting->plot_number = $data['plot_number'];
            $reprinting->total_copies = $data['total_copies'];
            $reprinting->agree = $data['agree'];
            $reprinting->save();

            return response()->json([
                'status' => 1,
                'info' => 'Operation successful. Click ok . . .',
                'redirect' => route('client.reprinting.checkout', ['id' => $reprinting->id]),
            ]);
        } catch (Exception $error) {
            return response()->json([
                'status' => 0,
                'info' => 'Operation failed. Try again'
            ]);
        }
    }

    //
    public function checkout($id = 0)
    {
        $reprinting = Reprinting::find($id);
        return view('client.reprinting.checkout', ['reprinting' => $reprinting]);
    }

}











