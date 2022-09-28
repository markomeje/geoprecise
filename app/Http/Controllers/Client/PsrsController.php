<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\{Psr, Form};
use Validator;
use Exception;

class PsrsController extends Controller
{
    //
    public function index($limit = 20)
    {
        $client = auth()->user()->client;
        return view('client.psrs.index', ['title' => 'All Property Search Requests', 'psrs' => Psr::latest()->where(['client_id' => ($client->id ?? 0)])->paginate($limit)]);
    }

    //
    public function save($id = 0)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'status' => ['required', 'string'], 
            'sold_by' => ['required', 'string'],
            'layout' => ['required', 'string'],
        ], ['sold_by.required' => 'Please enter the seller\'s name']);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $psr = Psr::find($id);
        if (empty($psr)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Psr not found.',
            ]);
        }

        $completed = true === (boolean)($data['completed'] ?? 0);
        if ($completed && empty($psr->plot_numbers)) {
            return response()->json([
                'status' => 0,
                'info' => 'Please add plots.',
            ]);
        }

        if ($completed && empty($psr->payment)) {
            return response()->json([
                'status' => 0,
                'info' => 'Incomplete application. No payment.',
            ]);
        }

        if ($completed && $psr->payment->status !== 'paid') {
            return response()->json([
                'status' => 0,
                'info' => 'Incomplete application. Invalid payment',
            ]);
        }

        if ($completed && (boolean)$psr->payment->approved !== true) {
            return response()->json([
                'status' => 0,
                'info' => 'Please completed payment first.',
            ]);
        }

        try{
            $psr->layout_id = $data['layout'];
            $psr->status = $data['status'];
            $psr->sold_by = $data['sold_by'];
            $psr->comments = $data['comments'] ?? '';
            $psr->status = $data['status'] ?? '';

            $psr->approved = false;
            $psr->completed = $completed;

            if (empty($psr->update())) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Operation failed. Try again.',
                ]);
            }

            return response()->json([
                'status' => 1,
                'info' => 'Request updated. Please wait . . .',
                'redirect' => route('client.psr.edit', ['id' => $psr->id]),
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
        return view('client.psrs.edit', ['title' => 'Edit Property Search Request', 'psr' => Psr::findOrFail($id)]);
    }

}
