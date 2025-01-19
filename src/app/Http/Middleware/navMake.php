<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Actions\partytax\SetCurrentRoom;

class navMake
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUrl = request()->url();

        preg_match('/(?<=room\/).*/', $currentUrl, $currentUrl);

        
        if(empty($currentUrl[0])){
            session()->put('is_root_partytax_pages', true);
        } elseif(strpos($currentUrl[0], '/') != false){
            session()->put('is_root_partytax_pages', false);
        } else {
            session()->put('is_root_partytax_pages', true);
        }

        return $next($request);
    }
}
