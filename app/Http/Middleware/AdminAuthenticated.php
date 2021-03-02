<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AdminAuthenticated
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
        if(Auth::user()->role->name == 'customer'){
            return redirect('/welcome')->with('message', "You are Not Allowed To Access");
        }
        return $next($request);
    }
}
