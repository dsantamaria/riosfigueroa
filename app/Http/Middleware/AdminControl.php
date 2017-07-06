<?php

namespace App\Http\Middleware;

use Closure;
use Gate;

class AdminControl
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
        if (Gate::denies('admin-role')) {
            return redirect()->action('HomeController@index')->with('warning','No estas autorizado');
        }
        return $next($request);
    }
}
