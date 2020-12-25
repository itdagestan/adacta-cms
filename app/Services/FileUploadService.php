<?php
namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

final class FileUploadService
{

    const IMAGE_FOLDER_PATH = 'uploads/images';

    public string $filenameWithExtension;

    /**
     * @param $extension
     * @param string|null $name
     * @return string
     */
    public static function generateFilenameWithExtension(
        string $extension,
        string $name = null
    ): string
    {
        return !is_null($name)
            ? Str::slug($name).'_'.time().'.'.$extension
            : Str::random(25).'_'.time().'.'.$extension;
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
        string $folder = '/' . self::IMAGE_FOLDER_PATH,
        string $disk = 'public'
    ): void
    {
        if($filenameWithExtension === null) {
            $filenameWithExtension = static::generateFilenameWithExtension(
                $uploadedFile->getClientOriginalExtension()
            );
        }
        $this->filenameWithExtension = $filenameWithExtension;
        if (!$uploadedFile->storeAs($folder, $this->filenameWithExtension, $disk)) {
            throw new \Exception();
        }
    }

}
