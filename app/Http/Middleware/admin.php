<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class admin
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
        if (!Auth::user()->admin)
        {
            Session::flash('info','Not allowed to perform this action');
            return redirect()->back();
        }
        return $next($request);
    }
}
