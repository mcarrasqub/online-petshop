<?php

namespace App\Utils;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductImageService
{
    public function store(UploadedFile $image): string
    {
        // Determine which disk to use (gcs if configured, otherwise public local)
        $disk = config('filesystems.default') === 'gcs' ? 'gcs' : 'public';
        
        $path = Storage::disk($disk)->put('products', $image);

        return $path;
    }

    public function replace(?string $currentPath, UploadedFile $newImage): string
    {
        $this->delete($currentPath);

        return $this->store($newImage);
    }

    public function delete(?string $path): void
    {
        if (! $path || str_starts_with($path, 'http')) {
            return;
        }

        $disk = config('filesystems.default') === 'gcs' ? 'gcs' : 'public';
        
        if (Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
        }
    }
}
