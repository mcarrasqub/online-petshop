<?php

namespace App\Providers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductImageServiceProvider
{
    public function store(UploadedFile $image): string
    {
        File::ensureDirectoryExists(public_path('img/products'));

        $imageName = $image->hashName();
        $image->move(public_path('img/products'), $imageName);

        return 'img/products/'.$imageName;
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
            File::delete(public_path($path));

            return;
        }

        Storage::disk('public')->delete($path);
    }
}
