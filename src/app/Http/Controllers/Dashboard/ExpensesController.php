<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Expense;
use App\Models\RoomMember;
use App\Models\MemberExpense;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Actions\Dashboard\FindExpensePriceWillStore;

class ExpensesController extends Controller
{    
    public function index()
    {
        $thisRoomExpenses = Expense::where('room_id', session()->get('current_room'))->get();

        return view('dashboard.rooms.expenses',  ['pageName' => 'Траты', 'RoomExpenses' => $thisRoomExpenses]);
    }

    public function create()
    {
        return view('dashboard.rooms.expenses-add', ['pageName' => 'Добавить трату']);
    }

    public function store(FindExpensePriceWillStore $findExpensePriceWillStore)
    {
        $PriceWillStore = $findExpensePriceWillStore->handle($_POST);

        Expense::create([
            'name' => $_POST['expense-name'],
            'room_id' => session()->get('current_room'),
            'price' => $PriceWillStore,
            'count' => $_POST['expense-count'],
        ]);

        return redirect()->route('dashboard.room.expenses');
    }


    public function show($id)
    {
        $showableExpense = Expense::where('id', $id)->get()->first();
        
        $contributorsFor = MemberExpense::where('expense_id', $id)->get();
        $contributorsFor2 = [];

        foreach($contributorsFor as $contributor){
            array_push($contributorsFor2, $contributor->member_id);
        }

        $contributorsList = RoomMember::whereIn('id', $contributorsFor2)->get();

        return view('dashboard.rooms.expenses-show', ['pageName' => 'Редактирование товара', 'currentExpense' => $showableExpense, 'contributorsList' => $contributorsList]);
    }

    public function remove($id)
    {
        $thisRoomExpenses = Expense::where('room_id', session()->get('current_room'))->get();

        DB::table('member_expenses')->where('expense_id', $id)->delete();
        DB::table('expenses')->where('id', $id)->delete();

        return redirect()->route('dashboard.room.expenses');
    }
}