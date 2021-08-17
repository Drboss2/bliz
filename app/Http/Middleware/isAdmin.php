<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdmin
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
      if(auth()->user()->isadmin == 1 || auth()->user()->isadmin  == 2){
            return $next($request);
        }else{
          return redirect('/login')->with('admin_status','user access denied');
        }
        
    }
}
