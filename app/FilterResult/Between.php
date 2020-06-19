<?php

namespace App\FilterResult;
use Closure;

class Between
{
    
    public function handle($request , Closure $next)
    {
        $data = $next($request);
        
        if (!request()->has('balanceMin') || !request()->has('balanceMax')) {
            return $data;
        }else{
            $needles = ['balance'];
            return searchProviders($data,$needles,range(request('balanceMin'),request('balanceMax')));
        }
    }
}
