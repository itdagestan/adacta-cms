<?php
namespace App\Services;

use App\Interfaces\FileUpload;
use Illuminate\Http\UploadedFile;

final class FileUploadService implements FileUpload
{

    const IMAGE_FOLDER_PATH = '/uploads/images';

    public ?string $filenameWithExtension;
    public FileHelperService $fileHelperService;

    public function __construct()
    {
        $this->fileHelperService = new FileHelperService();
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param string|null $filenameWithExtension
     * @param string $folder
     * @param string $disk
     */
    public function uploadOneThumbnail(
        UploadedFile $uploadedFile,
        string $filenameWithExtension = null,
        string $folder = self::IMAGE_FOLDER_PATH,
        string $disk = 'public'
    ): void
    {
        if($filenameWithExtension === null) {
            $filenameWithExtension = $this->fileHelperService->generateFilenameWithExtension(
                $uploadedFile->getClientOriginalExtension()
            );
        }
        $this->filenameWithExtension = $filenameWithExtension;
        if (!$uploadedFile->storeAs($folder, $this->filenameWithExtension, $disk)) {
            throw new \Exception();
        }
    }

}
