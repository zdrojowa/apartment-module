<?php

namespace Selene\Modules\ApartmentModule\Commands;

use Illuminate\Console\Command;
use Selene\Modules\ApartmentModule\Services\CrmApartmentService;

class UpdateApartmentsCommand extends Command
{
    /** @var string */
    protected $signature = 'apartment:update';

    /** @var string */
    protected $description = 'Update apartments';

    public function handle(CrmApartmentService $service)
    {
        try {
            $service->update();
        } catch (\Exception $exception) {
            return 1;
        }
    }
}
