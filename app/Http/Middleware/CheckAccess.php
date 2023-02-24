<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAccess
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
        $user = $request->user();

        if ($user->role == 'admin') {

            return $next($request);
        }

        else if ($user->access == 'no') {

            $request->session()->invalidate();
            return redirect('/')->with('error', 'Your account is pending verification by our team.');
        }

        else if ($user->access == 'denied') {

            $request->session()->invalidate();
            return redirect('/')->with('error', 'Your account has been denied by an administrator.');
        }

        else if ($user->access == 'yes') {

            return redirect('/muro')->with('succes', 'Welcome to the application this is your WALL');
        }

        else if ($user->access == 'banned') {

            $request->session()->invalidate();
            return redirect('/')->with('error', 'Your account has been banned.');
        }

        return $next($request);
    }
}
