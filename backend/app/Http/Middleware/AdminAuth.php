<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle($request, Closure $next)
    {
        // If not logged in as admin, redirect to /admin/login
        if (!session()->has('admin_id')) {
            return redirect('/admin/login');
        }

        return $next($request);
    }
}
