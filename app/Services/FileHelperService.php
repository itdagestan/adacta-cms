<?php
namespace App\Services;

use Illuminate\Support\Str;

class FileHelperService
{

    /**
     * @param $extension
     * @param string|null $name
     * @return string
     */
    public function generateFilenameWithExtension(
        string $extension,
        string $name = null
    ): string
    {
        return !is_null($name)
            ? Str::slug($name).'_'.time().'.'.$extension
            : Str::random(25).'_'.time().'.'.$extension;
    }

}
