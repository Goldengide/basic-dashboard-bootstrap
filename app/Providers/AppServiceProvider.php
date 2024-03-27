<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Support\CustomPathGenerator;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(PathGenerator::class, CustomPathGenerator::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
