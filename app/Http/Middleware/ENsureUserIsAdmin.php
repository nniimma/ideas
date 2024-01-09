<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ENsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // todo: Log::info('before code execution');
        // ! simplest way to authenticate:
        if (!auth()->user()->is_admin) {
            abort(403);
        }
        // ! next will go to controller and execute the codes in the controller(the controller that is defined in the route):
        // ! so middleware help in executing some codes before the controller and after it:
        $response = $next($request);
        // todo: Log::info('after code execution');
        return $response;
    }
}
