<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Repositories\Menu\RecursiveMenuRepository;

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
            Session::put('menus', RecursiveMenuRepository::recursive());

        return $next($request);
    }
}
