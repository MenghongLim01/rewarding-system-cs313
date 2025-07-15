<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class CustomAdminRedirect
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return $next($request);
            }
        }

        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect()->route('admin.login');
        }
        if ($request->is('staff') || $request->is('staff/*')) {
            return redirect()->route('staff.login.form');
        }

        return redirect()->route('login');
    }
}
