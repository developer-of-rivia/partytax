<?php

namespace App\Http\Controllers\PartyTaxService;

use App\Models\RoomMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MemberController extends Controller
{
    public function indexMembers()
    {
        $thisPageMembers = RoomMember::where('room_id', session('current_room'))->get();

        return view('partytax.rooms.members', ['members' => $thisPageMembers, 'pageName' => 'Участники']);
    }



    public function addMemberPage()
    {
        return view('partytax.rooms.members-add', ['pageName' => 'Добавить участника']);
    }




    public function addMember(Request $request)
    {
        RoomMember::create([
            'name' => $request->get('room-member-name'),
            'room_id' => session()->get('current_room'),
            'relationships_id' => null,
        ]);
        
        return redirect()->route('partytax-room-mebmers');
    }
    



    public function removeMember($id)
    {
        RoomMember::where('id', $id)->delete();
    }
}