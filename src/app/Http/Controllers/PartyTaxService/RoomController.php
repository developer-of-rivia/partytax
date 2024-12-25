<?php

namespace App\Http\Controllers\PartyTaxService;

use App\Models\Room;
use App\Models\Expense;
use App\Models\RoomMember;
use App\Http\Controllers\Controller;
use App\Models\MemberExpense;



class RoomController extends Controller
{
    /* info */
    public function indexInfo()
    {
        $current_room_data = Room::where('id', session()->get('current_room'))->get()->first();
        $current_room_members_count = RoomMember::where('room_id', session()->get('current_room'))->get()->count();

        return view('partytax.rooms.main', ['pageName' => 'Информация о комнате', 'roomData' => $current_room_data, 'membersCount' => $current_room_members_count]);
    }

    
    /* results */
    public function indexResults()
    {
        $allMembers = RoomMember::where('room_id', session()->get('current_room'))->get();
        $allMembersResults = [];
        
        foreach($allMembers as $member){
            $hisExpenses = MemberExpense::where('member_id', $member->id)->get();
            $hisResult = 0;

            foreach($hisExpenses as $expense){
                $currentExpense = Expense::where('id', $expense->expense_id)->get()->first()->price;
                $contributorsCount = MemberExpense::where('expense_id', $expense->expense_id)->get()->count();
                $contributorsPart = $currentExpense / $contributorsCount;
                $contributorsPart = number_format($contributorsPart);

                $hisResult = $hisResult + $contributorsPart;
            }
            
            $allMembersResults[$member->name] = $hisResult;
        }

        return view('partytax.rooms.results',  ['pageName' => 'Результаты', 'allMembersResults' => $allMembersResults]);
    }


    /* indexSettings */
    public function indexSettings()
    {
        return view('partytax.rooms.settings',  ['pageName' => 'Настройки комнаты']);
    }
}