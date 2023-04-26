<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            // Check if the request URL contains 'admin'
            if ($request->is('admin/*')) {
                return route('admin.auth.login');
            }
            // Check if the request URL contains 'store'
            elseif ($request->is('store/*')) {
                return route('store.auth.login');
            }
            // Default redirection, if no specific route is matched
            else {
                return route('admin.auth.login');
            }
        }
    }
}
