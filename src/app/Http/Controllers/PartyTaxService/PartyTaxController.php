<?php

namespace App\Http\Controllers\PartyTaxService;
use App\Models\Room;
use App\Models\RoomMember;
use Illuminate\Http\Request;
use App\Models\roomSubscribers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Actions\Room\RoomLinkCreator;
use App\Actions\Partytax\SetCurrentRoom;


class PartyTaxController extends Controller
{
    public function homepage()
    {
        return view('partytax.home', ['pageName' => false]);
    }

    public function indexFavsPage()
    {
        return view('partytax.rooms.favs', ['pageName' => 'Избранные']);
    }

    public function indexFavsAddPage()
    {
        return view('partytax.rooms.favs-add', ['pageName' => 'Добавление в избранные']);
    }






    public function indexRooms()
    {
        // dd(session()->all());

        $roomsUserCreator = Room::where('creator_id', session()->get('id'))->get();

        $roomsUserSubscriber = DB::table('room_subscribers')->where('user_id', session()->get('id'))
            ->join('rooms', function($join){
                $join->on('room_subscribers.room_id', '=', 'rooms.id');
            })
            ->select('rooms.id', 'rooms.name')
            ->get();


        return view('partytax.rooms.all-rooms', ['roomsUserCreator' => $roomsUserCreator, 'roomsUserSubscriber' => $roomsUserSubscriber, 'pageName' => false]);
    }










    public function changeRoom(SetCurrentRoom $changeRoomAction, $id)
    {
        $changeRoomAction->setChoisenRoomID($id);
        $changeRoomAction->handle();
        return redirect()->route('partytax-rooms');
    }

    



    public function indexEnterPage()
    {
        return view('partytax.enter');
    }

    public function enter()
    {
        
    }


    // создание комнаты
    public function indexCreatePage()
    {
        return view('partytax.create', ['pageName' => 'Создать комнату']);
    }

    public function createRoom(Request $request, RoomLinkCreator $roomLinkCreator)
    {
        $createdRoom = Room::create([
            'name' => $request->get('room-name'),
            'password' => $request->get('room-pass'),
            'link' => $roomLinkCreator->handle(),
            'creator_id' => session()->get('id'),
        ]);

        session()->put('current_room', $createdRoom->id);
        return redirect()->route('partytax-rooms');
    }

    // перестать отслеживать
    public function forgetRoom($id)
    {
        RoomMember::where('room_id', $id)->update(['relationships_id' => null]);
        return redirect()->route('partytax-rooms');
    }




    /**/
    /**/
    /**/


    public function indexSubscribersAddPage()
    {
        return view('partytax.rooms.subscribers', ['pageName' => 'Отслеживать комнату']);
    }


    public function subscribersAdd(SetCurrentRoom $setCurrentRoom)
    {
        $requestRoom = Room::where('link', $_POST['roomLink'])->where('password', $_POST['roomPass'])->get()->first();

        roomSubscribers::create([
            'user_id' => session()->get('id'),
            'room_id' => $requestRoom->id,
        ]);

        $setCurrentRoom->setChoisenRoomID($requestRoom->id);
        $setCurrentRoom->handle();

        return redirect()->route('partytax-rooms');
    }

    
    public function subscribersRemove($id)
    {
        roomSubscribers::where('room_id', $id)->delete();
        
        session()->forget('current_room');

        return redirect()->route('partytax-rooms');
    }
}