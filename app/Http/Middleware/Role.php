<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Role
{
    public function handle($request, Closure $next, ...$allowedRoles)
    {
        // Mendapatkan user dari request
        $user = Auth::user();

        // Memeriksa apakah user ada dan memiliki role yang sesuai
        if ($user && in_array($user->user_role_id, $allowedRoles)) {
            return $next($request);
        }

        // Menggunakan ResponseFormatter untuk menghasilkan respons kesalahan
        return ResponseFormatter::error(
            null,
            'Oopss... Kamu Tidak Mempunyai Hak Akses',
            403 // Kode status 403 untuk Forbidden
        );
    }
}
