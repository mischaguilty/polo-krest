<?php

namespace App\Http\Middleware;

use Akaunting\Language\Middleware\SetLocale;
use Closure;

class AppLangMiddleware extends SetLocale
{
    // function handle($request, Closure $next)
    // {
    //     dd(language());
    // }
}
