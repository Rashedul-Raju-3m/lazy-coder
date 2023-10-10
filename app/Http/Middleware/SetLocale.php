<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    private $locales = ['ar', 'en', 'bn'];
    public function handle($request, Closure $next)
    {

        if (array_search($request->segment(1), $this->locales) === false) {
            return redirect('/en/home');
        }
        URL::defaults(['locale' => $request->segment(1)]);

        App::setLocale($request->segment(1));

        return $next($request);
    }
}
