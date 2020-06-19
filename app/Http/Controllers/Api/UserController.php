<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use App\FilterResult\Provider;
use App\FilterResult\StatusCode;
use App\FilterResult\Between;
use App\FilterResult\Currency;

class UserController extends Controller
{
    public function index()
    {
        /*
            Using Helper Function in App\helper
            If You Want To Add Another Json File Name Should Be ex DataProviderZ and add it into $providers array
        */
        
        $providers = [
            readJsonFile('DataProviderX','users'),
            readJsonFile('DataProviderY','users'),
        ];
        $filter[] = app(Pipeline::class)
                  ->send(combineProviders($providers))
                  ->through([
                    Provider::class,
                    StatusCode::class,
                    Between::class,
                    Currency::class
                  ])->thenReturn();

        return $filter;
    }
}
