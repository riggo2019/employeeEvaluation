<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user) {
            if ($user->is_admin == 1 && !$request->routeIs('admin.index')) {
                return redirect()->route('admin.index')->with('message', 'Bạn đã đăng nhập thành công với tư cách quản trị viên')->with('type', 'success');
            } elseif (!$request->routeIs('home.index')) {
                return redirect()->route('home.index');
            }
        }

        return $next($request);
    }
}
