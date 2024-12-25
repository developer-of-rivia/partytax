<?php

namespace App\Http\Controllers\PartyTaxService;
use App\Models\Room;
use App\Models\RoomMember;
use Illuminate\Http\Request;
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
        // получаем все комнаты, в которых участвует данный юзер
        $roomsID = [];
        $RelationsUserMember = RoomMember::where('relationships_id', session()->get('id'))->get();
        $roomsUserMember = [];
        foreach($RelationsUserMember as $item)
        {
            array_push($roomsID, $item->room_id);
        }
        foreach($roomsID as $item)
        {
            array_push($roomsUserMember, Room::where('id', $item)->get()->first());
        }

        // все комнаты, которые создал данный юзер
        $roomsUserCreator = Room::where('creator_id', session()->get('id'))->get();
        return view('partytax.rooms.all-rooms', ['roomsUserCreator' => $roomsUserCreator, 'roomsUserMember' => $roomsUserMember, 'pageName' => false]);
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


    // присоединиться к комнате
    public function indexJoinPage()
    {
        return view('partytax.joinpage', ['pageName' => 'Отслеживать комнату']);
    }
}