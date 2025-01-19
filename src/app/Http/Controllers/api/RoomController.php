<?php

namespace App\Http\Controllers\api;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Requests\TestRequest;
use App\Http\Controllers\Controller;
use App\Actions\Room\RoomLinkCreator;

class RoomController extends Controller
{
    public function index()
    {
        return Room::all();
    }

    public function store(TestRequest $request, RoomLinkCreator $roomLinkCreator)
    {
        $createdRoom = Room::create([
            'name' => $request->name,
            'password' => $request->password,
            'link' => $roomLinkCreator->handle(),
            'creator_id' => $request->creator_id,
        ]);

        return $createdRoom;
    }

    public function show($id)
    {
        return Room::query()->findOrFail($id);
    }

    public function update(Request $request)
    {

    }
}
