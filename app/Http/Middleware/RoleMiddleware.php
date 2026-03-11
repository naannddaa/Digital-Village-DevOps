<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // jika belum login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // cek role user
        if ((int) Auth::user()->level !== (int) $role) {
            abort(403, 'Akses ditolak');
        }

        return $next($request);
    }
}