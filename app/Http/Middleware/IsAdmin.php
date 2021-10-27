<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Response as FacadeResponse;

class IsAdmin
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
        //return $next($request);
        if(auth()->user()->is_admin == 1){
            return $next($request);
            return redirect('admin/home')->with('error',"You don't have admin access.");
        }elseif(auth()->user()->is_admin == 0){
            return $next($request);
            return redirect('/home')->with('error',"You don't have admin access.");
        }else{
            return $next($request);
            return redirect('/login')->with('error',"You don't have admin access.");
        }

        
   
        
    }
}
