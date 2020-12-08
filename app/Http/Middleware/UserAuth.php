<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // If User logined
        if(session()->has('user')){
            if($request->path()=="login" || $request->path()=="register"){
                return redirect('/');
            }
        }
        return $next($request);
    }
}
