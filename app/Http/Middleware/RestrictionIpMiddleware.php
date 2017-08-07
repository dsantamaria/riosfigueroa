<?php

namespace App\Http\Middleware;

use Closure;
use Gate;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class RestrictionIpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //return $next($request);   
        if (Gate::denies('admin-role')) {
            $client = new Client([
                'base_uri' => 'https://freegeoip.net/json/'
            ]);
            $request_ip = '201.167.64.179';//$request->ip(); //
            $result = $client->request('GET', $request_ip)->getBody()->getContents();
            $country = json_decode($result, true)['country_name'];

            if($country != 'Mexico'){
                return redirect()->action('HomeController@errorCountry');
            }
        }
        return $next($request);
    }
}
