<?php

namespace Ivareti\IntegrationApiIa;

use Illuminate\Support\ServiceProvider;

class IntegrationApiIaServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/integration-ia.php', 'integration-ia');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/integration-ia.php' => config_path('integration-ia.php'),
            ], 'config');
        }
    }
}
