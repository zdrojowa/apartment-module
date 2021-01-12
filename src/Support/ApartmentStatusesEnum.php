<?php

namespace Selene\Modules\ApartmentModule\Support;

use MyCLabs\Enum\Enum;

class ApartmentStatusesEnum extends Enum
{
    protected const AVAILABLE = 'available';
    protected const RESERVED = 'reserved';
    protected const SOLD = 'sold';
}
