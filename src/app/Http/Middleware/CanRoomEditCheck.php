<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CanRoomEditCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isMyRoom = Room::where('creator_id', Auth::user()->id)->where('id', session()->get('current_room'))->count();

        if($isMyRoom == 1){
            session()->put('canIEditThisRoom', true);
        }
        else
        {
            session()->put('canIEditThisRoom', false);
        }

        return $next($request);
    }
}