<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ApiServiceFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sightengineService';
    }
}
