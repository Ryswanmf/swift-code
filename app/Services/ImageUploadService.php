<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadService
{
    /**
     * Upload an image file, convert to WebP, and store in public storage.
     */
    public static function uploadAsWebp(UploadedFile $file, string $folder = 'uploads', int $quality = 85): string
    {
        $contents = file_get_contents($file->getRealPath());
        $image = @imagecreatefromstring($contents);

        $filename = Str::random(32).'.webp';
        $destinationPath = Storage::disk('public')->path("{$folder}/{$filename}");

        // Ensure target folder exists
        Storage::disk('public')->makeDirectory($folder);

        if ($image !== false && function_exists('imagewebp')) {
            if (imageistruecolor($image) === false) {
                imagepalettetotruecolor($image);
            }
            imagealphablending($image, true);
            imagesavealpha($image, true);

            imagewebp($image, $destinationPath, $quality);
            imagedestroy($image);
        } else {
            // Fallback: standard file store
            $path = $file->store($folder, 'public');

            return Storage::url($path);
        }

        return "/storage/{$folder}/{$filename}";
    }
}
