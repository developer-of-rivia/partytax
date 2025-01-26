<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\RoomMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class MemberController extends Controller
{
    /**
     * Display members of room
     */
    public function index()
    {
        $thisPageMembers = RoomMember::where('room_id', session('current_room'))->get();

        return view('dashboard.members', ['members' => $thisPageMembers, 'pageName' => 'Участники']);
    }

    /**
     * Display room member create page
     */
    public function create()
    {
        return view('dashboard.members-add', ['pageName' => 'Добавить участника']);
    }

    /**
     * Store a newly created member
     */
    public function store(Request $request)
    {
        RoomMember::create([
            'name' => $request->get('room-member-name'),
            'room_id' => session()->get('current_room'),
        ]);
        
        return redirect()->route('dashboard.room.members');
    }

    /**
     * Display room member edit page
     */
    public function edit($id)
    {
        $memberName = RoomMember::where('id', $id)->get()->first()->name;

        return view('dashboard.members-edit', ['memberName' => $memberName, 'id' => $id, 'pageName' => 'Редактировать участника']);
    }

    /**
     * Update room member information
     */
    public function update($id)
    {
        $member = RoomMember::where('id', $id);
        
        $member->update([
            'name' => $_POST['Name']
        ]);

        return redirect()->route('dashboard.room.members.edit', $id);
    }

    
    /**
     * Destroy room member
     */
    public function destroy($id)
    {
        DB::table('member_expenses')->where('member_id', $id)->delete();
        RoomMember::where('id', $id)->delete();

        return redirect()->route('dashboard.room.members');
    }
}