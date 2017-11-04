<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Support\Facades\DB;

use Closure;

class GuardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::find($request->input('user_id'));
        if(!$user)
            return response()->json([
                'success' => false,
                'message' => 'You are not registered as a Member!'
            ], 401);
        if($user->token != $request->input('token'))
            return response()->json([
                'success' => false,
                'message' => 'Invalid Token!'
            ]);
        return $next($request);
    }
}
