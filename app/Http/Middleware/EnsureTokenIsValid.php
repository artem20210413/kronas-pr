<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $res = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => $request->header('Authorization'),

        ])->post('https://auth.kronas.com.ua/api/v1/my/roles');
        if ($res->status() == 200) {
            return $next($request);
        }
        return response()->json([
            "code" => 401,
            'status' => 'Fail',
            'type' => 'error',
            'message' => 'unauthorized'
        ], 401);

    }
}
