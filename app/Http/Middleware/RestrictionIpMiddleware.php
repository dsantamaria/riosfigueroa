<?php

namespace App\Http\Middleware;

use Closure;
use Gate;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Auth;

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
        if (Gate::denies('admin-role') && Gate::denies('special-role')) {
            $request_ip = /*'201.167.64.179';*/ $request->ip();
            $url = 'http://api.ipstack.com/'.$request_ip;
            $client = new Client();
            $result = $client->request('GET', $url, ['query' => ['access_key' => '9dae0fb37b38452f57077727af8e1873']])->getBody()->getContents();
            $country = json_decode($result, true)['country_name'];

            if($country != 'Mexico'){
                return redirect()->action('HomeController@errorCountry');
            }
        }
        return $next($request);
    }
}
