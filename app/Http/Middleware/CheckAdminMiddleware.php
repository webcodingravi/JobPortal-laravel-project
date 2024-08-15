<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if($request->user() == null) 
        {
            return redirect()->route('front.home');
           
        }


        if($request->user()->role !== 'admin') 
        {
            session()->flash('error', 'You are not Authorized to access this page.');
            return redirect()->route('account.profile');
           
        }

            return $next($request);
        
        
    }
}
