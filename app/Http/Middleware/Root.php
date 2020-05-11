<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class Root
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
        if(!session('user')){
            return redirect('adminlogin');
        }
        $name = session('user');
        $root = DB::select("select level from admin where name = '{$name}'");
        if($root[0]->level != 0){
            return redirect("adminerror");
        }
        return $next($request);
    }
}
