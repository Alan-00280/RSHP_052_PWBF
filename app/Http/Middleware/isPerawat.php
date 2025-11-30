<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Symfony\Component\HttpFoundation\Response;

class isPerawat
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

        if(!\in_array(Session::get('role_id'), [1, 3])) {
            return back()->with('error', 'Akses ditolak!');
        }

        return $next($request);
    }
}
