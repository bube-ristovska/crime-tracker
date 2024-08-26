<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckBoth
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user has either 'policeman' or 'officer' role
        if (Session::get('auth')) {
            return $next($request);
        }

        return redirect()->route('unauth');
    }
}
