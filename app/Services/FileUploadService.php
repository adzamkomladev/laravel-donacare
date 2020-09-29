<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    /**
     * Upload file into directory in 'public' folder and make it accessible.
     *
     * @return string
     **/
    public function upload($file, string $directory)
    {
        $fileName = rand(123456, 9876558987654) . '.' . $file->extension();
        $path = Storage::putFileAs(
            'public/' . $directory,
            $file,
            "{$directory}_{$fileName}"
        );

        return str_replace('public', 'storage', $path);
    }
}
