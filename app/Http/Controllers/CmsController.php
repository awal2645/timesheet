<?php

namespace App\Http\Controllers;

use App\Models\Cms;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CmsController extends Controller
{
    /**
     * Display the CMS management page
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cms = Cms::first() ?? new Cms();
        return view('cms.index', compact('cms'));
    }
   
    /**
     * Handle file uploads from FilePond
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadFile(Request $request)
    {
        try {
            // FilePond sends the file with the key 'file'
            if (!$request->hasFile('file')) {
                // If no file is found, check if it's sent differently by FilePond
                $file = $request->file;
                
                if (!$file) {
                    Log::error('No file found in the request');
                    return response()->json(['error' => 'No file uploaded'], 400);
                }
            } else {
                $file = $request->file('file');
            }

            // Log file details for debugging
            Log::info('File Upload Attempt', [
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize()
            ]);

            // Validate file
            if (!$file->isValid()) {
                Log::error('File upload failed', [
                    'error' => $file->getError()
                ]);
                return response()->json(['error' => 'File upload failed'], 400);
            }

            // Generate a unique file name using uniqid() to prevent naming conflicts
            $fileName = uniqid('upload_') . '.' . $file->getClientOriginalExtension();

            // Save the file to the public/images directory for web accessibility
            $file->move(public_path('images'), $fileName);

            // Return the file path for FilePond to use
            $fullPath = 'images/' . $fileName;
            
            Log::info('File uploaded successfully', ['path' => $fullPath]);

            return response()->json($fullPath);
        } catch (\Exception $e) {
            // Log any unexpected errors for debugging
            Log::error('File upload exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Handle file deletion requests from FilePond
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFile(Request $request)
    {
        try {
            // FilePond sends the full path as the request body
            $filePath = $request->getContent();

            // Ensure the path is relative to public directory for security
            $publicPath = public_path($filePath);

            // Delete the file if it exists
            if (File::exists($publicPath)) {
                File::delete($publicPath);
                return response()->json(true);
            }

            Log::warning('Attempted to delete non-existent file', ['path' => $filePath]);
            return response()->json(['error' => 'File not found'], 404);
        } catch (\Exception $e) {
            Log::error('File deletion error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update CMS content including multiple image fields
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Fetch the first CMS record or create if none exists
        $cms = Cms::first();

        // Define all image fields that can be updated
        $fields = [
            'banner_image', 
            'approach_image', 
            'client_image1', 
            'client_image2', 
            'client_image3', 
            'client_image4', 
            'client_image5', 
            'client_image6', 
            'client_image7', 
            'features_image1', 
            'features_image2'
        ];

        foreach ($fields as $field) {
            if ($request->hasFile($field)) {
                // Remove old image if it exists to prevent storage buildup
                if ($cms->$field && file_exists(public_path($cms->$field))) {
                    unlink(public_path($cms->$field));
                }

                // Save the new image with a standardized name
                $request->file($field)->move(public_path('/images'), 'images/'.$field.'.png');
                $cms->$field = 'images/'.$field.'.png';
            }
        }

        // Persist changes to database
        $cms->save();

        return redirect()->back()->with('success', __('CMS updated successfully.'));
    }
}