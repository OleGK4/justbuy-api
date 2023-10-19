<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user->role && $user->role->name == 'admin') {
            return $next($request);
        } else {
            return response()->json(['message' => 'Forbidden for you!'], 403);
        }
    }
}
