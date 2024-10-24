<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class admin
{
    public function handle($request, Closure $next)
    {
        // Cek apakah pengguna sudah login dan memiliki peran admin
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Jika bukan admin, redirect ke halaman home
        return redirect('/');
    }
}