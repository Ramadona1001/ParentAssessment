<?php

namespace App\FilterResult;
use Closure;

class StatusCode
{
    
    public function handle($request , Closure $next)
    {
        $data = $next($request);
        if (!request()->has('statusCode')) {
            return $data;
        }else{
            $needles = ['status','statusCode'];
            if (request('statusCode') == 'authorised') {
                return searchProviders($data,$needles,[1,100]);
            }elseif (request('statusCode') == 'decline') {
                return searchProviders($data,$needles,[2,200]);
            }elseif (request('statusCode') == 'refunded') {
                return searchProviders($data,$needles,[3,300]);
            }
        }
    }
}
