<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CheckPoliceman
{
    public function handle(Request $request, Closure $next)
    {
        if (Session::get('is_policeman')) {
            return $next($request);
        }

        return redirect()->route('unauth');
    }
}
