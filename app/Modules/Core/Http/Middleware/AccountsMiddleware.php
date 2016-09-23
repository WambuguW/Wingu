<?php

namespace App\Modules\Core\Http\Middleware;

use Closure;

class AccountsMiddleware
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
        if(!$request->user()->hasRole('Accounts')){
            return abort(401);
        }
        return $next($request);
    }
}
