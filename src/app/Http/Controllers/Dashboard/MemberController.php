<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\RoomMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class MemberController extends Controller
{
    public function index()
    {
        $thisPageMembers = RoomMember::where('room_id', session('current_room'))->get();

        return view('dashboard.members', ['members' => $thisPageMembers, 'pageName' => 'Участники']);
    }



    public function create()
    {
        return view('dashboard.members-add', ['pageName' => 'Добавить участника']);
    }



    public function edit($id)
    {
        return view('dashboard.members-edit', ['id'=> $id, 'pageName' => 'Редактировать участника']);
    }



    public function store(Request $request)
    {
        RoomMember::create([
            'name' => $request->get('room-member-name'),
            'room_id' => session()->get('current_room'),
        ]);
        
        return redirect()->route('dashboard.room.mebmers');
    }
    



    public function destroy($id)
    {
        DB::table('member_expenses')->where('member_id', $id)->delete();
        RoomMember::where('id', $id)->delete();

        return redirect()->route('dashboard.room.mebmers');
    }
}