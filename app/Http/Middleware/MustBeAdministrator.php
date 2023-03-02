<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MustBeAdministrator
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()?->username !== "MikeSmith") {
            abort(403);
        }
        return $next($request);
    }
}
