<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\{Psr, Form};
use Validator;
use Exception;

class PsrController extends Controller
{
    //
    public function save()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'status' => ['required', 'string'], 
            'layout' => ['required', 'integer'],
            'soldby' => ['required', 'string', 'max:255'],
        ], ['soldby.required' => 'Enter the seller\'s name']);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors(),
            ]);
        }

        if (empty($data['plots'])) {
            return response()->json([
                'status' => 0,
                'info' => 'Please select plot number(s)'
            ]);
        }

        $plots = $data['plots'];
        $plots = is_array($plots) ? implode('-', $plots) : $plots;

        try{
            $psr = Psr::create([
                'plots' => $plots,
                'form_id' => Form::where(['code' => 'PSR'])->pluck('id')->toArray()[0],
                'description' => $data['description'],
                'layout_id' => $data['layout'],
                'completed' => true,
                'user_id' => auth()->id(),
                'status' => $data['status'],
            ]);

            return ($psr->id > 0) ? response()->json([
                'status' => 1,
                'info' => 'Operation successful.'
            ]) : response()->json([
                'status' => 0,
                'info' => 'Operation error. Try again.'
            ]);
        }catch(Exception $exception) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ]);
        } 
    }

}
