<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Symfony\Component\HttpFoundation\Response;

class isDokter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        if (! Auth::check()) {
            Session::flush();
            return redirect(route('login'));
        }

        if ( Session::get('role_id') !== 2) {
            return back()->with('error', 'Akses ditolak!');
        }

        return $next($request);
    }
}
