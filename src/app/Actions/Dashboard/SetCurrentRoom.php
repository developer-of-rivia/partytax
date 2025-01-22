<?php
namespace App\Actions\Dashboard;
use App\Models\Room;


class SetCurrentRoom
{
    private $choisenRoomID;
    private $roomInfo;

    public function setChoisenRoomID($roomID)
    {
        $this->choisenRoomID = $roomID;
    }

    private function pickRoomInfo()
    {
        $roomInfo = Room::where('id', $this->choisenRoomID)->first();
        $this->roomInfo = $roomInfo;
    }

    public function handle()
    {
        $this->pickRoomInfo();
        session()->put('currentRoom_link', $this->roomInfo->link);
        session()->put('currentRoom_name', $this->roomInfo->name);
        session()->put('currentRoom_creator_id', $this->roomInfo->creator_id);
        session()->put('current_room', $this->choisenRoomID);
    }
}