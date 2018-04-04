<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role1, $role2=null)
    {
      // if ($role2 == null) {
      //   $role2 = $role1;
      // }
      if (\Auth::user()->role == $role1 || \Auth::user()->role == $role2){
        // dd($request->user(), $role);
        return $next($request);

      }
      return back();
    }
}
