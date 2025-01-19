<?php

namespace App\Http\Controllers\PartyTaxService;

use App\Models\Room;
use App\Models\Expense;
use App\Models\RoomMember;
use App\Models\MemberExpense;
use Illuminate\Support\Facades\DB;
use App\Services\RoomResultService;
use App\Http\Controllers\Controller;



class RoomController extends Controller
{
    private $roomResultService;

    public function __construct(RoomResultService $roomResultService)
    {
        $this->roomResultService = $roomResultService;
    }

    /**
     * 
     */

    public function indexInfo()
    {
        $current_room_data = Room::where('id', session()->get('current_room'))->get()->first();
        $current_room_members_count = RoomMember::where('room_id', session()->get('current_room'))->get()->count();

        return view('partytax.rooms.main', ['pageName' => 'Информация о комнате', 'roomData' => $current_room_data, 'membersCount' => $current_room_members_count]);
    }

    public function indexResults()
    {
        $this->roomResultService->setCurrentRoom(session()->get('current_room'));
        $this->roomResultService->prepareResults();

        return view('partytax.rooms.results',  ['pageName' => 'Результаты', 'allMembersResults' => $this->roomResultService->getMemberResults()]);
    }



    /* indexSettings */
    public function indexSettings()
    {
        $current_room_data = Room::where('id', session()->get('current_room'))->get()->first();
        $current_room_members_count = RoomMember::where('room_id', session()->get('current_room'))->get()->count();

        return view('partytax.rooms.settings',  ['pageName' => 'Настройки комнаты', 'roomData' => $current_room_data, 'membersCount' => $current_room_members_count]);
    }



    public function roomUpdate()
    {
        $roomName = $_POST['roomName'];
        $roomLink = $_POST['roomLink'];
        $roomPassword = $_POST['roomPassword'];
        $roomDesc = $_POST['roomDescription'];

        DB::table('rooms')->where('id', session()->get('current_room'))->update([
            'name' => $roomName,
            'link' => $roomLink,
            'password' => $roomPassword,
            'description' => $roomDesc
        ]);

        return redirect()->route('partytax-room-info');
    }
}