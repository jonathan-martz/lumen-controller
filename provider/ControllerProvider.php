<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ControllerProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'general');
    }
}
