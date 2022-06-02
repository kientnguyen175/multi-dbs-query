<?php

namespace App\Http\Middleware;

use Closure;

class BasicAuth
{
    public function handle($request, Closure $next)
    {
        $AUTH_USER = config('basicauth.username');
        $AUTH_PASSWORD = config('basicauth.password');
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        $has_supplied_credentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));
        $is_not_authenticated = (
            !$has_supplied_credentials ||
            ($_SERVER['PHP_AUTH_USER'] != $AUTH_USER) ||
            ($_SERVER['PHP_AUTH_PW'] != $AUTH_PASSWORD)
        );
        if ($is_not_authenticated) {
            header('HTTP/1.1 401 Authorization Required');
            header('WWW-Authenticate: Basic realm="Access denied"');
            exit;
        }

        return $next($request);
    }
}
