<?php

namespace App\Utils;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductImageService
{

    public function store(UploadedFile $image): string
    {
        return $image->store('products', 'gcs');
    }

    public function replace(?string $currentPath, UploadedFile $newImage): string
    {
        $this->delete($currentPath);

        return $this->store($newImage);
    }

    public function delete(?string $path): void
    {
        if (! $path) {
            return;
        }

        if (str_starts_with($path, 'img/')) {
            if (File::exists(public_path($path))) {
                File::delete(public_path($path));
            }
            return;
        }

        Storage::disk('gcs')->delete($path);
    }
}
