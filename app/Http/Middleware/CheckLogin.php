<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class CheckLogin
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
        
        if(Auth::check()){
            return $next($request);
            // $user = Auth::user();
            // if($user->quyen==1)
            //      return $next($request);
            // else
            //     return redirect('admin/login');
           
        }
        return redirect('login');
    }
}
