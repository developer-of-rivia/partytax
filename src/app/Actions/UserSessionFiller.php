<?php
namespace App\Actions;

use Illuminate\Http\Request;

class UserSessionFiller
{
    private $request;
    private $userCollection;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function setUserCollection($userCollection)
    {
        foreach($userCollection as $item)
        {
            $this->userCollection = $item;
        }
    }

    public function handle()
    {
        $this->request->session()->put(['id' => $this->userCollection->id]);
        $this->request->session()->put(['login' => $this->userCollection->login]);
        $this->request->session()->put(['password' => $this->userCollection->password]);
        $this->request->session()->put(['name' => $this->userCollection->name]);
        $this->request->session()->put(['nickname' => $this->userCollection->nickname]);
        $this->request->session()->put(['accLink' => $this->userCollection->accLink]);
    }
}