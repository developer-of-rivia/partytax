<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Room;
use App\Models\Expense;
use Illuminate\View\View;
use App\Models\RoomMember;
use App\Models\MemberExpense;
use Illuminate\Support\Facades\DB;
use App\Services\RoomResultService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class RoomController extends Controller
{
    private $roomResultService;

    public function __construct(RoomResultService $roomResultService)
    {
        $this->roomResultService = $roomResultService;
    }

    /**
     * Display info page
    */
    public function indexInfoPage(): View
    {
        $current_room_data = Room::where('id', session()->get('current_room'))->get()->first();
        $current_room_members_count = RoomMember::where('room_id', session()->get('current_room'))->get()->count();

        return view('dashboard.main', ['pageName' => 'Информация о комнате', 'roomData' => $current_room_data, 'membersCount' => $current_room_members_count]);
    }

    /* 
     * Display settings page
     */
    public function indexSettingsPage(): View
    {
        $current_room_data = Room::where('id', session()->get('current_room'))->get()->first();
        $current_room_members_count = RoomMember::where('room_id', session()->get('current_room'))->get()->count();

        return view('dashboard.settings',  ['pageName' => 'Настройки комнаты', 'roomData' => $current_room_data, 'membersCount' => $current_room_members_count]);
    }

    /**
     * Room info Update
     */
    public function roomInfoUpdate(): RedirectResponse
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

        return redirect()->route('dashboard.room.info');
    }

    /**
     * Display results page
     */
    public function indexResultsPage(): View
    {
        $this->roomResultService->setCurrentRoom(session()->get('current_room'));
        $this->roomResultService->prepareResults();

        return view('dashboard.results',  ['pageName' => 'Результаты', 'allMembersResults' => $this->roomResultService->getMemberResults()]);
    }
}