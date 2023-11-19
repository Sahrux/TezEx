<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class AuthenticationCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path =  $request->path();
        if ((Auth::check() && $path !== "login" || ($path === "login" && !Auth::check()))) {
            return $next($request);
        }else if($path === "login" && Auth::check()){
            return redirect("/");
        }

        return redirect('/login');
    }
}
