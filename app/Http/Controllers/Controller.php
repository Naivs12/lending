<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadFile($file)
    {
        $identifier = Str::random(20);

        // Determine the file extension
        $fileExtension = strtolower($file->getClientOriginalExtension());

        // Initialize options and tags arrays
        $options = [];
        $tags = [];

        // Check if the file is a video or image and set the appropriate resource type
        if (in_array($fileExtension, ['mp4', 'avi', 'mov', 'mkv', 'webm'])) {
            // Video upload
            $options['resource_type'] = 'video';
        } else {
            // Default to image upload
            $options['resource_type'] = 'image';
        }

        // Perform the upload to Cloudinary
        try {
            $result = \LaravelCloudinary::upload($file->getRealPath(), $identifier, $options, $tags);

            return $identifier;
        } catch (\Exception $e) {
            // Handle any errors during the upload
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
