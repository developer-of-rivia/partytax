<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Room;
use Illuminate\View\View;
use App\Models\RoomMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Actions\Room\RoomLinkCreator;
use Illuminate\Http\RedirectResponse;
use App\Actions\Dashboard\SetCurrentRoom;


class DashboardController extends Controller
{
    /**
     * Display dashboard home page
     */
    public function indexHomePage(): View
    {
        return view('dashboard.home', ['pageName' => 'home']);
    }

    /**
     * Display favorites page
     */
    public function indexFavoritesPage(): View
    {
        return view('dashboard.favs', ['pageName' => 'Избранные']);
    }

    /**
     * Display favorites add page
     */
    public function indexFavoritesAddPage(): View
    {
        return view('dashboard.favs-add', ['pageName' => 'Добавление в избранные']);
    }

    /**
     * Display all rooms page
     */
    public function indexAllRoomsPage(): View
    {
        $roomsUserCreator = Room::where('creator_id', Auth::user()->id)->get();

        $roomsUserSubscriber = DB::table('room_subscribers')->where('user_id', Auth::user()->id)
            ->join('rooms', function($join){
                $join->on('room_subscribers.room_id', '=', 'rooms.id');
            })
            ->select('rooms.id', 'rooms.name')
            ->get();


        return view('dashboard.all-rooms', ['roomsUserCreator' => $roomsUserCreator, 'roomsUserSubscriber' => $roomsUserSubscriber, 'pageName' => 'Все комнаты']);
    }

    /**
     * Change current room session
     */
    public function changeRoom(SetCurrentRoom $changeRoomAction, $id): RedirectResponse
    {
        $changeRoomAction->setChoisenRoomID($id);
        $changeRoomAction->handle();
        return redirect()->route('dashboard.all-rooms');
    }

    /**
     * Display create room page
     */
    public function indexCreatePage()
    {
        return view('dashboard.create', ['pageName' => 'Создать комнату']);
    }

    /**
     * Create Room
     */
    public function createRoom(Request $request, RoomLinkCreator $roomLinkCreator): RedirectResponse
    {
        $createdRoom = Room::create([
            'name' => $request->get('room-name'),
            'password' => $request->get('room-pass'),
            'link' => $roomLinkCreator->handle(),
            'creator_id' => Auth::user()->id,
        ]);

        session()->put('current_room', $createdRoom->id);
        return redirect()->route('dashboard.all-rooms');
    }
}