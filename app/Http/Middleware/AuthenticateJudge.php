<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateJudge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // login for whether or not can procced else redirected back
        $value = session('Judge_user');

        if ($value == null) {
            return redirect('/JudgeLogin');
        }

        // redirect judge to the page when the authentication is accepted
        return $next($request);
    }
}
