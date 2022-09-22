<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Sib, Client, Form, Survey};
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
        if (empty($data['survey_id']) || empty($data['client_id'])) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid operation.',
            ]);
        }

        $client = Client::where(['id' => $data['client_id']])->first();
        if (empty($client)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Client not found.',
            ]);
        }

        $survey = Survey::where(['id' => $data['survey_id']])->first();
        if (empty($survey)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Survey not found.',
            ]);
        }

        if ((boolean)$survey->approved !== true) {
            return response()->json([
                'status' => 0,
                'info' => 'Survey must be approved first.',
            ]);
        }

        try {
            $sib = Sib::create([
                'client_id' => $data['client_id'],
                'recorded_by' => auth()->id(),
                'survey_id' => $data['survey_id'],
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
                'info' => 'Operation successful. Click ok . . .',
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
        $data = request()->all(['approved', 'comments']);
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
            $sib->comments = $data['comments'] ?? '';
            $sib->approved = $approved;
            if ($approved) {
                $sib->completed = true;
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
                'info' => 'Operation successful. Please wait . . .',
                'redirect' => route('admin.sib.edit', ['id' => $sib->id]),
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
        $sib = Sib::find($id);
        if (empty($sib)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Sib not found.',
            ]);
        }

        if ($sib->delete()) {
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
