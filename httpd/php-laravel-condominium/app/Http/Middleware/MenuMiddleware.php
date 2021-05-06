<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Models\Menu;

class MenuMiddleware
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
        if (auth()->check() && !Session::has('menus'))
            Session::put('menus', Menu::recursive());

        return $next($request);
    }
}
