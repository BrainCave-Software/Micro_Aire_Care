<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckOrders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $assigned = explode(",", $user->assigned_modules);
        if (in_array("orders", $assigned)|| $user->role_id==0) {
           
        return $next($request);
    } else {
        return redirect()->route('SA-Dashboard')->with("error", "You don't have access to this module, Please Contact your Administrator!");
    }
    }
}
