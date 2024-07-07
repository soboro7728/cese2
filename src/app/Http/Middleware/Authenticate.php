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
        // if (! $request->expectsJson()) {
        //     return route('login');
        // }
        if (!$request->expectsJson()) {
            if ($request->is('admin/*')) {
                return route('admin.login');
            }
            if ($request->is('shopadmin/*')) {
                return route('shopadmin.login');
            }
            if ($request->is('/*')) {
                return route('guest');
            }
            // return route('login');
            // return route('guest');
        }
        
        // if (!$request->expectsJson()) {
            
        //     return route('login');
        // }
    }
}
