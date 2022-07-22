<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Validator;

class DocumentsController extends Controller
{
    //
    public function index()
    {
        return view('client.documents.index', ['title' => 'My Documents']);
    }

    //
    public function add()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'type' => ['required', 'string'], 
            'description' => ['nullable', 'string'],
        ]);

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

        $document = Document::create([
            'type' => $data['type'],
            'description' => $data['description'],
            'user_id' => auth()->id()
        ]);

        if (empty($document)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again later',
            ]);
        }

        return response()->json([
            'status' => 1,
            'info' => 'Document added. Please wait . . .',
            'redirect' => '',
        ]);
    }

}
