<?php

namespace Selene\Modules\ApartmentModule\Commands;

use Illuminate\Console\Command;
use Selene\Modules\ApartmentModule\Services\CrmApartmentService;

class UpdateApartmentsCommand extends Command
{
    /** @var string */
    protected $signature = 'apartment:update {building} {type=apartment}';

    /** @var string */
    protected $description = 'Update apartments';

    public function handle(CrmApartmentService $service)
    {
        try {
            $service->update($this->argument('building') >> 0, $this->argument('type'));
        } catch (\Exception $exception) {
            return 1;
        }
    }
}
