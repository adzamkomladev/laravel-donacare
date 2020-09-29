<?php

namespace App\Services;

use App\Donation;

class PrescriptionService
{
    /** @var \App\Services\FileUploadService $fileUploadService  */
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Add prescriptions
     *
     * @return \App\File[]
     **/
    public function createMany(array $files, Donation $donation)
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
}
