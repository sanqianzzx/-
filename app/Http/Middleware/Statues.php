<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class Statues
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
        //网站关闭  404 功能
        $status = DB::select("select status from status");
        if(!$status){

            // return redirect("./error");
        }
        return $next($request);
    }
}
