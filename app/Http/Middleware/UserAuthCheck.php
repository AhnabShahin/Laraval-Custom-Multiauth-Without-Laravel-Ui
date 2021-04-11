<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class UserAuthCheck
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
        if(!session()->has('LoggedUser') && ($request->path()!='user/login' && $request->path() !='user/registration' )){
            return redirect('user/login')->with('MustLogin','You must be login');
        }
        if(session()->has('LoggedUser') && ($request->path()=='user/login' || $request->path() == 'user/registration')){
            return back();
        }
        return $next($request)->header('Cache-Control','no-cache,no-store,max-age=0, must-revalidate')
                              ->header('Pragma','no-cache')
                              ->header('Expires','Sat 01 Jan 1900 00:00:00 GMT');
    }
}
