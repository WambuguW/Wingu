<?php

namespace App\Modules\Core\Http\Middleware;

use Closure;

class ExamsMiddleware
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
        if(!$request->user()->hasRole('Examinations')){
            return abort(401);
        }
        return $next($request);
    }
}
