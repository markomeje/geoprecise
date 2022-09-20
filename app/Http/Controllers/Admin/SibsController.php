<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Sib, Client, Form};
use Carbon\Carbon;
use Validator;

class SibsController extends Controller
{
    //
    public function index($limit = 20)
    {
        return view('admin.sibs.index', ['title' => 'Site Inspection Bookings', 'sibs' => Sib::latest()->paginate($limit)]);
    }

    //
    public function apply()
    {
        $data = request()->all();
        $validator = Validator::make($data, [ 
            'layout' => ['required', 'string'],
            'client' => ['required'],
        ], ['sold_by.required' => 'Please enter the seller\'s name', 'client.required' => 'Please select client.']);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $client = Client::where(['id' => $data['client']])->first();
        if (empty($client)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Client not found.',
            ]);
        }

        try {
            $sib = Sib::create([
                'layout_id' => $data['layout'],
                'client_id' => $client->id,
                'recorded_by' => auth()->id(),
                'survey_id' => 0,
                'recorder_type' => 'staff',
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
                'info' => 'Request added. Please wait . . .',
                'redirect' => route('admin.sib.edit', ['id' => $sib->id]),
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
        return view('admin.sibs.edit', ['title' => 'Edit Site Inspection Booking', 'sib' => Sib::find($id)]);
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

        $Sib = Sib::find($id);
        if (empty($Sib)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Sib not found.',
            ]);
        }

        $approved = (boolean)($data['approved'] ?? 0) === true;
        if ($approved && empty($Sib->payment)) {
            return response()->json([
                'status' => 0,
                'info' => 'Incomplete Sib. No payment.',
            ]);
        }

        if ($approved && $Sib->payment->status !== 'paid') {
            return response()->json([
                'status' => 0,
                'info' => 'Incomplete Sib. Invalid payment',
            ]);
        }

        try{
            $Sib->layout_id = $data['layout'];
            $Sib->status = $data['status'];
            $Sib->sold_by = $data['sold_by'];
            $Sib->comments = $data['comments'] ?? '';
            $Sib->status = $data['status'] ?? '';

            $Sib->approved = $approved;
            $Sib->completed = $approved;

            if ($approved) {
                $Sib->approved_by = auth()->id();
                $Sib->approved_at = Carbon::now();
            }

            if (empty($Sib->update())) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Operation failed. Try again.',
                ]);
            }

            return response()->json([
                'status' => 1,
                'info' => 'Request updated. Please wait . . .',
                'redirect' => route('admin.Sib.edit', ['id' => $Sib->id]),
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
        $Sib = Sib::find($id);
        if (empty($Sib)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Sib not found.',
            ]);
        }

        if ($Sib->delete()) {
            return response()->json([
                'status' => 1,
                'info' => 'Operation successful.',
                'redirect' => '',
            ]);
        }

        return response()->json([
            'status' => 0,
            'info' => 'Failed to delete Sib',
        ]);
    }


}
