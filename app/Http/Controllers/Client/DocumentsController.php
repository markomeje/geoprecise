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
    public function upload()
    {
        $file = request()->file('document');
        // dd($document);
        $validator = Validator::make(['file' => $file], [
            'file' => ['required', 'mimes:jpg,png,jpeg,pdf']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $data = request()->all(['model_id', 'model', 'type']);
        $type = $data['type'] ?? '';
        $model_id = $data['model_id'] ?? 0;
        $model = $data['model'] ?? '';

        if (empty($model_id) || empty($model)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Operation failed. Try again'
            ], 500);
        }

        $extension = strtolower($file->getClientOriginalExtension());
        $imagePath = 'documents/images';
        $pdfPath = 'documents/pdfs';
        if ($extension === 'pdf') {
            $type = 'pdf';
            $path = $pdfPath;
        }else {
            $type = 'image';
            $path = $imagePath;
        }

        $filename = \Str::uuid().'.'.$extension;
        $file->move($path, $filename);
        $url = config('app.url')."/{$path}/{$filename}";

        $document = Document::where(['model_id' => $model_id])->first();
        if (empty($document)) {
            $document = Document::create([
                'url' => $url,
                'model_id' => $model_id,
                'filename' => $filename,
                'format' => $extension,
                'type' => $type,
                'user_id' => auth()->id(),
                'model' => $model,
            ]);

            if ($document) {
                return response()->json([
                    'status' => 1, 
                    'info' => 'Operation successful'
                ]);
            }

            return response()->json([
                'status' => 1, 
                'info' => 'Operation failed'
            ], 500);
            
        }

        if (!empty($document->url)) {
            $doc_parts = explode('/', $document->url);
            $path = $document->type == 'pdf' ? $pdfPath : $imagePath;
            $prev_doc = end($doc_parts);
            $file = "{$path}/{$prev_doc}";
            if (file_exists($file)) {
                unlink($file);
            }
        }
            
        $document->url = $url;
        $document->format = $extension;
        $document->filename = $filename;
        $document->type = $type;
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
        ], 500);
            
    }

    public function delete()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'model_id' => ['required'],
            'type' => ['required'],
            'role' => ['required'],
            'public_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid Operation.',
                'error' => $validator->errors()
            ]);
        }

        if ($data['role'] == 'main') {
            $others = Image::where([
                'type' => $data['type'], 
                'model_id' => $data['model_id'],
                'role' => 'others'
            ])->get();

            if ($others->count() > 0) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Not allowed. You must delete other images first.',
                ]);
            }   
        }

        try {
            $image = Image::where([
                'public_id' => $data['public_id'],
                'type' => $data['type'], 
                'model_id' => $data['model_id'], 
                'role' => $data['role'], 
            ])->get()->first();

            if (empty($image)) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Image not found. Check your fields'
                ]);
            }

            Cloudinary::delete([$image->public_id]);
            $image->delete();

            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'redirect' => '',
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status' => 0, 
                'info' => 'Unknown error. Try again.'
            ]);
        }     
    }

    /**
     * Upload multiple images with filepond
     */
    public function multiple()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'images' => ['required'],
            'model_id' => ['required'],
            'type' => ['required'],
            'folder' => ['required'],
            'role' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid Operation.',
                'error' => $validator->errors()
            ]);
        }

        $files = request()->file('images');
        if(!is_array($files) || count($files) <= 0){
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid files sent.'
            ]);
        }

        $type = $data['type'] ?? '';
        $image = Image::where([
            'model_id' => $data['model_id'], 
            'role' => $data['role'], 
            'type' => $type,
        ])->get();

        $maxfiles = ['property' => 4, 'material' => 3];
        if (isset($maxfiles[$type])) {
            if (($image->count() + count($files)) > $maxfiles[$type]) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Maximum file upload reached.'
                ]);
            }
        }

        $images = [];
        foreach($files as $file){
            $dinary = Cloudinary::save($data, $file);
            $images[] = $dinary;
        }

        return response()->json([
            'status' => $dinary['status'], 
            'info' => $dinary['info'],
            'images' => $images,
        ]);
    }

    /**
     * Upload API for Mobile
     */
    public function mobile()
    {
        try {
            $data = request()->only(['file', 'folder']);
            $upload = \Cloudder::upload($data['file'], \Str::uuid(), [
                'folder' => $data['folder'],
                'overwrite' => false,
                'resource_type' => 'image', 
                'responsive' => true,
            ]);

            if ($upload) {
                return response()->json([
                    'status' => 1, 
                    'info' => 'Operation successful',
                    'upload' => [
                        'public_id' => \Cloudder::getPublicId(), 
                        'upload' => $upload
                    ],
                ]);
            }

            return response()->json([
                'status' => 0, 
                'info' => 'Operation failed',
            ]);
        } catch (Exception $error) {
            return response()->json([
                'status' => $error->getCode(), 
                'info' => $error->getMessage()
            ]);
        }
            
    }

}