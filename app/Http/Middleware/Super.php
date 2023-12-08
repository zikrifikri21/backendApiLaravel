<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Super
{
    public function handle(Request $request, Closure $next)
    {
        if (Session::get('user_role_id') == 1) {
            return $next($request);
        }

        return back()->with('error', 'Oopss... Kamu Tidak Mempunyai Hak Akses');
    }
}
