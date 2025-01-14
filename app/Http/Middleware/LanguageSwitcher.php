<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

class LanguageSwitcher
{
    public function handle($request, Closure $next)
    {
        // Lấy ngôn ngữ từ session hoặc mặc định là 'vi'
        $locale = session('locale', 'vi');
        App::setLocale($locale);

        return $next($request);
    }
}
