<?php

namespace App\Http\Controllers;
use App\Models\Document;
use Exception;
use Validator;

/**
 * Handles the uploading all images
 */
class DocumentsController extends Controller
{

    /**
     * Upload Api for main file
     */
    public function change()
    {
        $file = request()->file('document');
        $data = request()->all(['model_id', 'model']);
        $validator = Validator::make(['document' => $file], [
            'document' => ['mimes:jpg,png,jpeg,pdf'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $model_id = $data['model_id'] ?? 0;
        $model = $data['model'] ?? '';

        if (empty($model_id) || empty($model)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Operation failed. Try again'
            ]);
        }

        $extension = strtolower($file->getClientOriginalExtension());
        $path = $extension === 'pdf' ? 'documents/pdfs' : 'documents/images';

        $filename = \Str::uuid().'.'.$extension;
        $file->move($path, $filename);
        $url = config('app.url')."/{$path}/{$filename}";

        $document = Document::where(['model_id' => $model_id])->first();
        if (!empty($document->url)) {
            $doc_parts = explode('/', $document->url);
            $prev_doc = end($doc_parts);
            $file = "{$path}/{$prev_doc}";
            if (file_exists($file)) {
                unlink($file);
            }
        }
            
        $document->url = $url;
        $document->format = $extension;
        $document->filename = $filename;
        $document->model = $model;

        if ($document->update()) {
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful'
            ]);
        }

        return response()->json([
            'status' => 0, 
            'info' => 'Operation faled'
        ]);

    }

    /**
     * Upload Api for main file
     */
    public function upload()
    {
        $file = request()->file('document');
        $data = request()->all(['model_id', 'model', 'type']);
        $validator = Validator::make(['type' => $data['type'], 'document' => $file], [
            'document' => ['mimes:jpg,png,jpeg,pdf'],
            'type' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $type = $data['type'] ?? '';
        $model_id = $data['model_id'] ?? 0;
        $model = $data['model'] ?? '';

        if (empty($model_id) || empty($model)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Operation failed. Try again'
            ]);
        }

        $documents = Document::where(['model_id' => $model_id])->get();
        foreach ($documents as $document) {
            if (strtolower($document->type) == strtolower($type)) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Document type already uploaded.'
                ]);
            }
        }
            

        $extension = strtolower($file->getClientOriginalExtension());
        $path = $extension === 'pdf' ? 'documents/pdfs' : 'documents/images';

        $filename = \Str::uuid().'.'.$extension;
        $document = Document::create([
            'url' => config('app.url')."/{$path}/{$filename}",
            'model_id' => $model_id,
            'filename' => $filename,
            'format' => $extension,
            'type' => $type,
            'user_id' => auth()->id(),
            'model' => $model,
        ]);

        if ($document->id > 0) {
            $file->move($path, $filename);
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'redirect' => ''
            ]);
        }

        return response()->json([
            'status' => 1, 
            'info' => 'Operation failed'
        ]);
            
    }

    public function delete($id = 0)
    {
        $data = request()->all();
        $document = Document::find($id);
        if (empty($document)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Operation failed'
            ]);
        }

        if (!empty($document->url)) {
            $url = explode('/', $document->url);
            $filename = end($url);

            $extension = explode('.', $filename);
            $path = end($extension) === 'pdf' ? 'documents/pdfs' : 'documents/images';

            $file = "{$path}/{$filename}";
            if (file_exists($file)) {
                unlink($file);
            }
        }

        if ($document->delete()) {
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'redirect' => ''
            ]);
        }    
    }

}