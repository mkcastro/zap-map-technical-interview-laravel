<?php

namespace App\Providers;

use App\Concretions\IndexLocationKm;
use App\Concretions\IndexLocationMi;
use App\Enums\UnitEnum;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('index_location_'.UnitEnum::KILOMETERS->value, IndexLocationKm::class);
        $this->app->bind('index_location_'.UnitEnum::MILES->value, IndexLocationMi::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
