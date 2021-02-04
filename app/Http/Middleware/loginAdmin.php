<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginAdmin
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
      if(Auth::check()){
        if(Auth::user()->admin != "1"){
            return redirect('/forum');
        }
      }else {
        return redirect('/forum');
      }


        return $next($request);
    }
}
