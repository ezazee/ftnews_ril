<?php

namespace UniSharp\LaravelFilemanager\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use UniSharp\LaravelFilemanager\Lfm;
use App\Helpers\ImageResizeHelper;

class UploadController extends LfmController
{
    protected $errors;

    public function __construct()
    {
        parent::__construct();
        $this->errors = [];
    }

    /**
     * Upload files
     *
     * @param void
     *
     * @return JsonResponse
     */
    public function upload()
    {
        $uploaded_files = request()->file('upload');
        $error_bag = [];
        $new_filename = null;
        $success_messages = [];
    
        foreach (is_array($uploaded_files) ? $uploaded_files : [$uploaded_files] as $file) {
            try {
                $originalName = preg_replace('/\s+/', '-', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                $extension = $file->getClientOriginalExtension();

                $filename = $originalName . '.' . $extension;
                $thumbFilename = $originalName . '.' . $extension;
    
                $resizeResult = ImageResizeHelper::resizeImage($file, $filename, $thumbFilename);
    
                if (isset($resizeResult['error'])) {
                    array_push($error_bag, 'Some error occurred during uploading.');
                    continue;
                }
    
                $url = Storage::url($resizeResult['path']);
                $thumbUrl = Storage::url($resizeResult['thumb_path']);
    
                $response = [
                    'url' => $url,
                    'thumb_url' => $thumbUrl,
                    'uploaded' => $url
                ];
            } catch (\Exception $e) {
                Log::error($e->getMessage(), [
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
                ]);
                $error_bag[] = $e->getMessage();
            }
        }
    
        return response()->json($error_bag ? ['error' => $error_bag] : $response);
    }
    
}
