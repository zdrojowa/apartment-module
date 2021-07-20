<?php

namespace Selene\Modules\ApartmentModule\Support;

use Illuminate\Http\UploadedFile;

/**
 * Class StorageAdapter
 * @package Selene\modules\ApartmentModule\src\Support
 */
class StorageAdapter
{
    /**
     * @param UploadedFile $file
     *
     * @return string - generated file name
     */
    private static function generateFilename(UploadedFile $file)
    {
        return md5(uniqid($file->getClientOriginalName(), true));
    }

    /**
     * @param UploadedFile $file
     * @param string $path - destination for file saving
     *
     * @return string - path to saved file
     */
    public static function saveFile(UploadedFile $file, string $path)
    {
        $filename = self::generateFilename($file);
        $resultPath = $file->move($path, $filename . '.' . $file->getClientOriginalExtension())->getPathName();

        return $resultPath;
    }
}
