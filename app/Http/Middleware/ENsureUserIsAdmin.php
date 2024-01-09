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
     ? first way to define role base functions:
     */
    // todo: public function handle(Request $request, Closure $next): Response
    // todo:{
    // Log::info('before code execution');
    // ! simplest way to authenticate:
    // todo: if (!auth()->user()->is_admin) {
    // todo:    abort(403);
    // todo: }
    // ! next will go to controller and execute the codes in the controller(the controller that is defined in the route):
    // ! so middleware help in executing some codes before the controller and after it:
    // todo: $response = $next($request);
    // Log::info('after code execution');
    // todo: return $response;
    // todo: }
}
