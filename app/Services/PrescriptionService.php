<?php

namespace App\Services;

use App\Donation;
use App\File;

class PrescriptionService
{
    /** @var \App\Services\FileUploadService $fileUploadService  */
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Add prescriptions from file uploads
     *
     * @return \App\File[]
     **/
    public function createManyFromFiles(array $files, Donation $donation)
    {
        $prescriptions = [];

        foreach ($files as $file) {
            $prescriptions[] = [
                'path' => $this->fileUploadService->upload($file, 'prescription')
            ];
        }

        $donation->files()->createMany($prescriptions);

        $donation->files;
    }

    /**
     * Add prescriptions from file urls
     *
     * @return \App\File[]
     **/
    public function createManyFromFileUrls(array $fileUrls, Donation $donation)
    {
        $prescriptions = collect($fileUrls)->map(function ($fileUrl) {
            return ['path' => $fileUrl];
        })->toArray();

        $donation->files()->createMany($prescriptions);

        return $donation->files;
    }

    /**
     * All prescriptions by a user
     *
     * @return \App\File[]
     **/
    public function findAllByUserId(int $userId)
    {
        return File::with('donation')->latest()->get()->reject(function ($file) use ($userId) {
            return $file->donation->user_id !== $userId;
        });
    }
}
