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
        ]);

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
            'layout' => ['required', 'string'],
            'client' => ['required'],
        ]);

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

        $approved = (boolean)($data['approved'] ?? 0) === true;
        if ($approved && empty($sib->payment)) {
            return response()->json([
                'status' => 0,
                'info' => 'Incomplete application. No payment.',
            ]);
        }

        if ($approved && $sib->payment->status !== 'paid') {
            return response()->json([
                'status' => 0,
                'info' => 'Incomplete application. Invalid payment',
            ]);
        }

        if ($approved && (boolean)$sib->payment->approved !== true) {
            return response()->json([
                'status' => 0,
                'info' => 'Please approved payment first.',
            ]);
        }

        try{
            $sib->layout_id = $data['layout'];
            $sib->comments = $data['comments'] ?? '';
            $sib->approved = $approved;
            $sib->completed = $approved;

            if ($approved) {
                $sib->approved_by = auth()->id();
                $sib->approved_at = Carbon::now();
            }

            if (empty($sib->update())) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Operation failed. Try again.',
                ]);
            }

            return response()->json([
                'status' => 1,
                'info' => 'Request updated. Please wait . . .',
                'redirect' => route('admin.sibs.edit', ['id' => $sib->id]),
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
