<?php
namespace App\Interfaces;

use Illuminate\Http\UploadedFile;
use App\Services\FileHelperService;

interface FileUpload
{

    public function uploadOneThumbnail(
        UploadedFile $uploadedFile,
        string $filenameWithExtension,
        string $folder,
        string $disk
    ): void;
}
