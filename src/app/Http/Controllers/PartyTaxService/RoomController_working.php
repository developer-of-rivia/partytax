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
        // получаем всех участников данной комнаты
        $allMembers = RoomMember::where('room_id', session()->get('current_room'))->get();
        // создаём массив нужных данных для вьюхи
        $allMembersResults = [];

        // начинаем по одному выбирать участников комнаты
        foreach($allMembers as $member){
            // берём все траты у конкретного итерируемого участника комнаты
            $hisExpenses = MemberExpense::where('member_id', $member->id)->get();
            // указываем начальную сумму скида
            $hisResult = 0;

            // начинаем по подному выбирать траты конкретного итерируемого участника комнаты
            foreach($hisExpenses as $expense){
                // получаем цену конкретной итерируемой траты
                $currentExpensePrice = Expense::where('id', $expense->expense_id)->get()->first()->price;
                // получаем количество людей, который скидываются на данную трату
                $contributorsCount = MemberExpense::where('expense_id', $expense->expense_id)->get()->count();
                
                // Делим цену траты на количество скидывающихся
                $contributorsPart = $currentExpensePrice / $contributorsCount;
                // приводим к формату до точки
                $contributorsPart = number_format($contributorsPart);

                // добавляем долю от данной траты в итогую сумму для участника
                $hisResult = $hisResult + $contributorsPart;
            }
            
            // наполняем массив нужных данных для вьюхи
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