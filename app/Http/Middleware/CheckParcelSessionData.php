<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckParcelSessionData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the required session data exists
        if (session()->has('step1Data')) {
            return $next($request);
        }

        session()->flash('error', 'Please create a parcel before accessing this page.');

        // Redirect or respond accordingly if session data is missing
        return redirect()->route('parcel.step1');
    }
}
