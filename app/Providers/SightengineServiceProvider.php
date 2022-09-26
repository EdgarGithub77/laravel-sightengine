<?php

namespace App\Providers;

use App\Services\SightengineService;
use Illuminate\Support\ServiceProvider;

class SightengineServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register ()
    {
        $this->app->bind('sightengineService',function(){
            return new SightengineService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
