<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckOfficer
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user has the 'officer' role
        if (!Session::get('is_policeman')) {
            return $next($request);
        }

        return redirect()->route('unauth');
    }
}
