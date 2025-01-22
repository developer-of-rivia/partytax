<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Room;
use App\Models\RoomMember;
use Illuminate\Http\Request;
use App\Models\roomSubscribers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Actions\Room\RoomLinkCreator;
use App\Actions\Dashboard\SetCurrentRoom;


class DashboardController extends Controller
{
    public function homepage()
    {
        return view('dashboard.home', ['pageName' => 'Home']);
    }

    public function indexFavsPage()
    {
        return view('dashboard.rooms.favs', ['pageName' => 'Избранные']);
    }

    public function indexFavsAddPage()
    {
        return view('dashboard.rooms.favs-add', ['pageName' => 'Добавление в избранные']);
    }






    public function indexRooms()
    {
        // dd(session()->all());

        $roomsUserCreator = Room::where('creator_id', Auth::user()->id)->get();

        // $roomsUserSubscriber = DB::table('room_subscribers')->where('user_id', Auth::user()->id)
        //     ->join('rooms', function($join){
        //         $join->on('room_subscribers.room_id', '=', 'rooms.id');
        //     })
        //     ->select('rooms.id', 'rooms.name')
        //     ->get();


        return view('dashboard.rooms.all-rooms', ['roomsUserCreator' => $roomsUserCreator, 'roomsUserSubscriber' => false, 'pageName' => 'Все комнаты']);
    }










    public function changeRoom(SetCurrentRoom $changeRoomAction, $id)
    {
        $changeRoomAction->setChoisenRoomID($id);
        $changeRoomAction->handle();
        return redirect()->route('dashboard.rooms');
    }

    



    public function indexEnterPage()
    {
        return view('dashboard.enter');
    }

    public function enter()
    {
        
    }


    // создание комнаты
    public function indexCreatePage()
    {
        return view('dashboard.create', ['pageName' => 'Создать комнату']);
    }

    public function createRoom(Request $request, RoomLinkCreator $roomLinkCreator)
    {
        $createdRoom = Room::create([
            'name' => $request->get('room-name'),
            'password' => $request->get('room-pass'),
            'link' => $roomLinkCreator->handle(),
            'creator_id' => Auth::user()->id,
        ]);

        session()->put('current_room', $createdRoom->id);
        return redirect()->route('dashboard.rooms');
    }

    // перестать отслеживать
    public function forgetRoom($id)
    {
        RoomMember::where('room_id', $id)->update(['relationships_id' => null]);
        return redirect()->route('dashboard.rooms');
    }




    /**/
    /**/
    /**/


    public function indexSubscribersAddPage()
    {
        return view('dashboard.rooms.subscribers', ['pageName' => 'Отслеживать комнату']);
    }


    public function subscribersAdd(SetCurrentRoom $setCurrentRoom)
    {
        $requestRoom = Room::where('link', $_POST['roomLink'])->where('password', $_POST['roomPass'])->get()->first();

        roomSubscribers::create([
            'user_id' => Auth::user()->id,
            'room_id' => $requestRoom->id,
        ]);

        $setCurrentRoom->setChoisenRoomID($requestRoom->id);
        $setCurrentRoom->handle();

        return redirect()->route('dashboard.rooms');
    }

    
    public function subscribersRemove($id)
    {
        roomSubscribers::where('room_id', $id)->delete();
        
        session()->forget('current_room');

        return redirect()->route('dashboard.rooms');
    }
}