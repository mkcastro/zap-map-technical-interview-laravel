<?php

namespace App\Providers;

use App\Factories\IndexLocationFactory;
use App\Interfaces\IndexLocationInterface;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IndexLocationInterface::class, function (Application $app) {
            $unit = request()->query('unit', 'km');

            return IndexLocationFactory::make($unit);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
