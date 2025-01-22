<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GenerateDashboardBreadcrumbs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $uri = $request->path();
        
        $uriDeep = substr_count($uri, '/');

        if($uriDeep > 2)
        {
            view()->share('doBacklinkNeed', true);
        }
        else
        {
            view()->share('doBacklinkNeed', false);
        }

        return $next($request);
    }
}
