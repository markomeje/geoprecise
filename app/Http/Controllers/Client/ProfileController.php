<?php

namespace App\Http\Controllers\Client;
use App\Models\Client;
use App\Http\Controllers\Controller;
use Validator;

class ProfileController extends Controller
{
    //
    public function index()
    {
        return view('client.profile.index', ['client' => auth()->user()->client]);
    }

    //
    public function edit()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'fullname' => ['required', 'string'], 
            'dob' => ['nullable', 'string'], 
            'occupation' => ['required', 'string'], 
            'address' => ['required', 'string'], 
            'city' => ['nullable', 'string'],
            'state' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
        ], ['dob.required' => 'Date of birth is required', 'dob.string' => 'Date of birth is invalid']);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $client = auth()->user()->client;
        if (empty($client)) {
            return response()->json([
                'status' => 0,
                'info' => 'An error occured. Try again later.',
            ]);
        }

        $client->fullname = $data['fullname'];
        $client->dob = $data['dob'] ?? null;
        $client->occupation = $data['occupation'] ?? null;
        $client->city = $data['city'] ?? null;
        $client->state = $data['state'] ?? null;
        $client->phone = $data['phone'] ?? null;
        $client->status = 'completed';

        if ($client->update()) {
            return response()->json([
                'status' => 1,
                'info' => 'Profile updated. Please wait . . .',
                'redirect' => route('client'),
            ]);
        }

        return response()->json([
            'status' => 0,
            'info' => 'Unknown error. Try again later',
        ]);
    }
}
