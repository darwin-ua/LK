<?php

namespace App\Http\Middleware;

use Closure;

class CheckBearerToken
{
    public function handle($request, Closure $next)
    {
        $apiToken = env('API_BEARER_TOKEN');

        if (!$apiToken) {
            return response()->json([
                'error' => 'API token is not configured',
            ], 500);
        }

        $validToken = 'Bearer ' . $apiToken;
        $incomingToken = (string) $request->header('Authorization');

        if (!hash_equals($validToken, $incomingToken)) {
            return response()->json([
                'error' => 'Unauthorized',
            ], 401);
        }

        return $next($request);
    }
}
