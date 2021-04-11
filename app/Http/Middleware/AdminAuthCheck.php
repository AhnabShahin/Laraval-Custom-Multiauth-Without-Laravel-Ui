<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class AdminAuthCheck
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
        if(!session()->has('LoggedAdmin') && ($request->path()!='admin/login' && $request->path() !='admin/registration' )){
            return redirect('admin/login')->with('MustLogin','You must be login');
        }
        if(session()->has('LoggedAdmin') && ($request->path()=='admin/login' || $request->path() == 'admin/registration')){
            return back();
        }
        return $next($request)->header('Cache-Control','no-cache,no-store,max-age=0, must-revalidate')
                              ->header('Pragma','no-cache')
                              ->header('Expires','Sat 01 Jan 1900 00:00:00 GMT');
    }
}
