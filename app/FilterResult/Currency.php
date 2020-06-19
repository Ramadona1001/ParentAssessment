<?php

namespace App\FilterResult;
use Closure;

class Currency
{
    
    public function handle($request , Closure $next)
    {
        $data = $next($request);
        if (!request()->has('currency')) {
            return $data;
        }else{
            $needles = ['currency','Currency'];
            return searchProviders($data,$needles,request('currency'));
        }
    }
}
