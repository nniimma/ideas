<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ! to see if our middleware is working or not:
        // todo: dd('hi');

        // ! check if the locale exists
        // ! if exists update the locale
        if (session()->has('locale')) {
            app()->setLocale(session()->get('locale'));
        }

        return $next($request);
    }
}
