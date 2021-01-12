<?php

namespace Selene\Modules\ApartmentModule\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Selene\Modules\ApartmentModule\ApartmentModule;

/**
 * Class Apartment
 * @package Selene\Modules\ApartmentModule\Models
 */
class Apartment extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'rooms_count',
        'number',
        'floor',
        'area',
        'terrace_area',
        'status',
        'pdf_uri',
        'image_uri',
    ];

    /**
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * @param array $data
     *
     * @return mixed
     */
    private function saveItem(array $data)
    {
        $data['pdf_uri'] = ApartmentModule::pdfUriPath() . $data['pdf_uri'];
        $data['area'] = number_format((float)$data['area'], 2);
        $data['terrace_area'] = number_format((float)$data['terrace_area'], 2);
        if (isset($data['images_uri'])) {
            $data['image_uri'] = ApartmentModule::imagesUriPath() . $data['image_uri'];
        }

        return $this->create($data);
    }

    /**
     * @param array $data
     */
    public function storeData(array $data)
    {
        foreach ($data as $item) {
            $this->saveItem($item);
        }
    }
}
