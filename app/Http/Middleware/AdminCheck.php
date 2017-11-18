<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminCheck
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
        if (!Auth::check())
        {
            return redirect('/login');
        }
        elseif(Auth::check()&&Auth::user()->id==1)
        {
            return $next($request);
        }
        else
        {
            return back();
        }

    }

}
