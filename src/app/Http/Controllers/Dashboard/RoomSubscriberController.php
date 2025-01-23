<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\RoomSubscriber;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Actions\Dashboard\SetCurrentRoom;


class RoomSubscriberController extends Controller
{
    /**
     * Index subscribers add page
     */
    public function indexSubscribersAddPage()
    {
        return view('dashboard.subscribers', ['pageName' => 'Отслеживать комнату']);
    }

    /**
     * Make subscribe on room
     */
    public function subscriberAdd(SetCurrentRoom $setCurrentRoom)
    {
        $requestRoom = Room::where('link', $_POST['roomLink'])->where('password', $_POST['roomPass'])->get()->first();

        RoomSubscriber::create([
            'user_id' => Auth::user()->id,
            'room_id' => $requestRoom->id,
        ]);

        $setCurrentRoom->setChoisenRoomID($requestRoom->id);
        $setCurrentRoom->handle();

        return redirect()->route('dashboard.all-rooms');
    }

    /**
     * Unsubscribe from room
     */
    public function subscriberRemove(Request $request)
    {
        RoomSubscriber::where('room_id', $request->roomID)->delete();
        
        session()->forget('current_room');

        return redirect()->route('dashboard.all-rooms');
    }
}
