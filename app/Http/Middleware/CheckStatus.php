<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckStatus
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
        if(Auth::check())
        {
            if( Auth::user()->status === 1 )
            {
                return $next($request);
            }else{
                Auth::logout();
                return redirect()->route('login')->with('message', "your acc disabled");
            }
        }

        if($request->route()->uri() !== 'login')
        {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
