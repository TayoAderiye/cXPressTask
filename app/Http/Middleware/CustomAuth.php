<?php

namespace App\Http\Middleware;

use App\Helpers\HelperFunctions;
use Closure;
use Illuminate\Http\Request;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $arrayInSession = HelperFunctions::returnAllInSession();
        if ($arrayInSession[0] == null || $arrayInSession[1] == null|| $arrayInSession[2] == null) {
            return redirect('/login')->with('message', "Please Login");
        }
        return $next($request);
    }
}
