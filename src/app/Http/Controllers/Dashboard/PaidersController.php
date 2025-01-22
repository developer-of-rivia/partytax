<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\RoomMember;
use Illuminate\Http\Request;
use App\Models\MemberExpense;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PaidersController extends Controller
{
    private $paidersForExpensesNumber; 




    /**
     * Страница со всеми участниками к трате
     */

    public function index($id)
    {
        $this->paidersForExpensesNumber = $id;

        $currentRoomMembers = RoomMember::where('room_id', session()->get('current_room'))->get();

        $currentExpensePaiders = DB::table('room_members')
            ->join('member_expenses', function($join){
                $join->on('room_members.id', '=', 'member_expenses.member_id');
            })
            ->select('member_expenses.member_id', 'member_expenses.expense_id')
            ->get();

        return view('dashboard.rooms.paiders', ['expenseNumber' => $this->paidersForExpensesNumber, 'roomMembers' => $currentRoomMembers, 'pageName' => 'Кто скидывается', 'currentExpensePaiders' => $currentExpensePaiders]);
    }



    /**
     * Добавить скидывающихся 
     */
    
    public function update()
    {
       $paidersFormPost = $_POST;

       MemberExpense::where('expense_id', $paidersFormPost['expenseNumber'])->delete();

       $keysToExclude = ['_token', 'expenseNumber'];

       $paidersKeys = array_keys(array_filter($paidersFormPost, function ($key) use ($keysToExclude) {
            return !in_array($key, $keysToExclude);
        }, ARRAY_FILTER_USE_KEY));


        foreach($paidersKeys as $key)
        {
            MemberExpense::create([
                'expense_id' => $paidersFormPost['expenseNumber'],
                'member_id' => $key,
            ]);
        }

        return redirect()->route('dashboard.room.expenses.show', $paidersFormPost['expenseNumber']);
    }
}