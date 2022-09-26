<?php

namespace App\Http\Controllers;

use App\Facades\ApiServiceFacade;
use App\Http\Requests\StoreFileRequest;
use Illuminate\Http\Request;

class SightengineController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreFileRequest $request)
    {
        return ApiServiceFacade::SightengineServiceData($request);
    }

}
