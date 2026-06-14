<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = session('locale');

        if (!$locale) {
            $locale = $request->cookie('guest_locale');
            
            if ($locale) {
                session(['locale' => $locale]);
            }
        }

        if (!$locale) {
            $locale = config('app.locale');
        }

        if (!in_array($locale, config('app.available_locales'))) {
            $locale = config('app.locale');
        }

        app()->setLocale($locale);

        return $next($request);
    }
}