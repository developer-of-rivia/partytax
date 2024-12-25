<?php

namespace App\Http\Controllers;

use App\Actions\UserSessionFiller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth');
    }

    public function auth(Request $request, UserSessionFiller $userSessionFiller)
    {
        $user = User::where('login', $request->get('login'))->where('password', $request->get('password'))->get();

        if($user->isNotEmpty())
        {
            $userSessionFiller->setUserCollection($user);
            $userSessionFiller->handle();

            session()->put('is_auth', true);

            return redirect()->route('partytax-home');
        }
        else
        {
            return redirect()->route('auth-page');
        }
    }

    public function logout()
    {
        session()->forget('is_auth');
        return redirect()->route('auth-page');
    }
}
