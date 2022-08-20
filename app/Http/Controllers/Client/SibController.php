<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\{Sib, Form};
use Validator;
use Exception;

class SibController extends Controller
{
    //
    public function add()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'layout' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors(),
            ]);
        }

        try{
            $sib = Sib::create([
                'form_id' => $data['form_id'],
                'layout_id' => $data['layout'],
                'completed' => false,
                'user_id' => auth()->id(),
            ]);

            return ($sib->id > 0) ? response()->json([
                'status' => 1,
                'info' => 'Operation successful.',
                'redirect' => route('client.sib.edit', ['id' => $sib->id])
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

    //
    public function edit($id = 0)
    {
        return view('client.sib.edit', ['sib' => Sib::find($id)]);
    }

    //
    public function update($id = 0)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'layout' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors(),
            ]);
        }

        try{
            $sib = Sib::create([
                'form_id' => $data['form_id'],
                'layout_id' => $data['layout'],
                'completed' => false,
                'user_id' => auth()->id(),
            ]);

            return ($sib->id > 0) ? response()->json([
                'status' => 1,
                'info' => 'Operation successful.',
                'redirect' => route('client.sib.edit', ['id' => $sib->id])
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
