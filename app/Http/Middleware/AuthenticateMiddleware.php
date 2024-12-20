<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class AuthenticateMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            // Nếu chưa đăng nhập, chỉ chuyển hướng đến login
            return redirect()->route('login')->with('message', 'Vui lòng đăng nhập')->with('type', 'error');
        } elseif ($user->is_admin == 0 && $request->routeIs('admin.*')) {
            // Nếu user không phải admin và cố vào admin route, chuyển hướng home
            return redirect()->route('home.index')->with('message', 'Bạn không có quyền truy cập trang này')->with('type', 'error');
        }

        return $next($request);
    }
}
