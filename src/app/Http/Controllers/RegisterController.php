<?php

namespace App\Http\Controllers;

use App\Actions\Register\AccLinkCreator;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function create(Request $request, AccLinkCreator $linkCreator)
    {   
        User::create([
            'login' => $request->get('login'),
            'password' => $request->get('password'),
            'name' => $request->get('name'),
            'nickname' => $request->get('secondname'),
            'accLink' => $linkCreator->handle(),
        ]);
    }
}
