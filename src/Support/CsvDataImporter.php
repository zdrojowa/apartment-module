<?php

namespace Selene\Modules\ApartmentModule\Support;

use Illuminate\Http\UploadedFile;

class CsvDataImporter
{
    private static function prepareData(UploadedFile $file)
    {
        $path = $file->getRealPath();

        return array_map('str_getcsv', file($path));
    }

    public static function prepareDataFrom(UploadedFile $file)
    {
        $header = null;
        $result = [];
        $data = self::prepareData($file);
        foreach ($data as $item) {
            if (!$header) $header = $item; else
                $result[] = array_combine($header, $item);
        }

        return $result;
    }
}
