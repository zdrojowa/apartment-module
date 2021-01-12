<?php

namespace Selene\Modules\ApartmentModule\Providers;

use Illuminate\Support\ServiceProvider;
use Selene\Modules\ApartmentModule\Commands\UpdateApartmentsCommand;
use Selene\Modules\ApartmentModule\Services\CrmApartmentService;

class ApartmentModuleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CrmApartmentService::class, function() {
            return new CrmApartmentService(
                config('selene.crm-apartment')['url'],
                config('selene.crm-apartment')['building']);
        });
        $this->app->bind('command.apartment:update', UpdateApartmentsCommand::class);

        $this->commands([
            'command.apartment:update',
        ]);
    }

    public function boot(){}
}
