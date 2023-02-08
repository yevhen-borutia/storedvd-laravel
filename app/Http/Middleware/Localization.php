<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Localization {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
//                            die(session('locale'));

        if (session()->has('locale')) {
//                    die(app()->getLocale());

            app()->setLocale(session('locale'));
        }
        return $next($request);
    }

}
