<?php

namespace App\Http\Middleware;

use Closure;

class RememberQueryStrings
{
    public function handle($request, Closure $next)
    {
        if ($request->ajax()) {
            return $next($request);
        }

        if (empty($request->all())) {
            return $this->remembered($next, $request);
        }

        if ($request->get('forget')) {
            return $this->forget($next, $request);
        }

        return $this->remember($next, $request);
    }

    protected function remembered($next, $request)
    {
        $remembered = array_filter($request->session()->get('remember_query_strings.'.$request->route()->getName()) ?? []);

        if ($remembered) {
            $request->session()->reflash();

            return redirect(url($request->path()).'?'.http_build_query($remembered));
        }

        return $next($request);
    }

    protected function remember($next, $request)
    {
        $request->session()->put('remember_query_strings.'.$request->route()->getName(), array_filter($request->all()));

        return $next($request);
    }

    protected function forget($next, $request)
    {
        $request->session()->remove('remember_query_strings.'.$request->route()->getName());

        return redirect(url($request->path()));
    }
}

