<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Pcf, Client, Form, Survey};
use Validator;

/**
 * Plan Collection Forms Controller
 */
class PcfsController extends Controller
{
    //
    public function index($limit = 20)
    {
        return view('admin.pcfs.index', ['title' => 'All Plan Collection Forms', 'pcfs' => Pcf::latest()->paginate($limit)]);
    }

    //
    public function record()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'plan_title' => ['required', 'string'], 
            'plan_number' => ['required', 'string'],
            'location' => ['required', 'string'],
            'client' => ['required', 'string'],
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
            $pcf = Pcf::create([
                'client_id' => $client->id,
                'recorded_by' => auth()->id(),
                'survey_id' => $survey->id,
                'recorder_type' => 'staff',
                'plan_title' => $data['plan_title'],
                'plan_number' => $data['plan_number'],
                'location' => $data['location'],
                'form_id' => Form::where(['code' => 'PCF'])->pluck('id')->toArray()[0],
            ]);

            if (empty($pcf->id)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Operation failed. Try again.',
                ]);
            }

            return response()->json([
                'status' => 1,
                'info' => 'Operation successful.',
                'redirect' => '',
            ]);
        } catch (Exception $error) {
            return response()->json([
                'status' => 0,
                'info' => 'Operation failed. Try again'
            ]);
        }
            
    }

    //
    public function issue($id = 0)
    {
        $pcf = Pcf::find($id);
        if (empty($pcf)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Record not found.',
            ]);
        }

        try {
            $pcf->issued = true;
            $pcf->issued_by = auth()->id();
            $pcf->issued_at = now();
            $pcf->collected = true;

            if (!$pcf->update()) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Operation failed. Try again.',
                ]);
            }

            return response()->json([
                'status' => 1,
                'info' => 'Operation successful.',
                'redirect' => '',
            ]);
        } catch (Exception $error) {
            return response()->json([
                'status' => 0,
                'info' => 'Operation failed. Try again'
            ]);
        }
            
    }

}