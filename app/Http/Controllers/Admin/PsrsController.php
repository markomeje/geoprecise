<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Psr, Client, Form};
use Carbon\Carbon;
use Validator;

class PsrsController extends Controller
{
    //
    public function index($limit = 20)
    {
        return view('admin.psrs.index', ['title' => 'All Property Search Requests', 'psrs' => Psr::latest()->paginate($limit)]);
    }

    //
    public function add($client_id = 0)
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

        $client = Client::where(['id' => $client_id])->first();
        if (empty($client)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Client not found.',
            ]);
        }

        $psr = Psr::create([
            'status' => $data['status'],
            'layout_id' => $data['layout'],
            'sold_by' => $data['sold_by'],
            'client_id' => $client_id,
            'comments' => $data['comments'] ?? null,
            'recorded_by' => auth()->id(),
            'recorder_type' => 'staff',
            'form_id' => Form::where(['code' => 'PSR'])->pluck('id')->toArray()[0],
        ]);

        if (empty($psr->id)) {
            return response()->json([
                'status' => 0,
                'info' => 'Operation failed. Try again.',
            ]);
        }

        return response()->json([
            'status' => 1,
            'info' => 'Request added. Please wait . . .',
            'redirect' => route('admin.psr.edit', ['id' => $psr->id]),
        ]);
    }

    //
    public function edit($id = 0)
    {
        return view('admin.psrs.edit', ['title' => 'Edit Property Search Request', 'psr' => Psr::findOrFail($id)]);
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

        $approved = (boolean)($data['approved'] ?? 0) === true;
        if ($approved && empty($psr->payment)) {
            return response()->json([
                'status' => 0,
                'info' => 'Incomplete application. No payment.',
            ]);
        }

        if ($approved && $psr->payment->status !== 'paid') {
            return response()->json([
                'status' => 0,
                'info' => 'Incomplete application. Invalid payment',
            ]);
        }

        if ($approved && (boolean)$psr->payment->approved !== true) {
            return response()->json([
                'status' => 0,
                'info' => 'Please approved payment first.',
            ]);
        }

        try{
            $psr->layout_id = $data['layout'];
            $psr->status = $data['status'];
            $psr->sold_by = $data['sold_by'];
            $psr->comments = $data['comments'] ?? '';
            $psr->status = $data['status'] ?? '';

            $psr->approved = $approved;
            $psr->completed = $approved;

            if ($approved) {
                $psr->approved_by = auth()->id();
                $psr->approved_at = Carbon::now();
            }

            if (empty($psr->update())) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Operation failed. Try again.',
                ]);
            }

            return response()->json([
                'status' => 1,
                'info' => 'Request updated. Please wait . . .',
                'redirect' => route('admin.psr.edit', ['id' => $psr->id]),
            ]);
        }catch(Exception $exception) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ]);
        }
    }

    //
    public function delete($id = 0)
    {
        $psr = Psr::find($id);
        if (empty($psr)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Psr not found.',
            ]);
        }

        if ($psr->delete()) {
            return response()->json([
                'status' => 1,
                'info' => 'Operation successful.',
                'redirect' => '',
            ]);
        }

        return response()->json([
            'status' => 0,
            'info' => 'Failed to delete PSR',
        ]);
    }


}
