<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Expense;
use App\Models\RoomMember;
use App\Models\MemberExpense;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Actions\Dashboard\FindExpenseInfoWillStore;

class ExpenseController extends Controller
{    
    public function index()
    {
        $thisRoomExpenses = Expense::where('room_id', session()->get('current_room'))->get();

        return view('dashboard.expenses',  ['pageName' => 'Траты', 'RoomExpenses' => $thisRoomExpenses]);
    }

    public function create()
    {
        return view('dashboard.expenses-add', ['pageName' => 'Добавить трату']);
    }

    public function store(FindExpenseInfoWillStore $findExpenseInfoWillStore)
    {
        $findExpenseInfoWillStore->setPostData($_POST);
        $findExpenseInfoWillStore->handle();

        Expense::create([
            'name' => $_POST['expense-name'],
            'room_id' => session()->get('current_room'),
            'price' => $findExpenseInfoWillStore->getPrice(),
            'count' => $_POST['expense-count'],
            'current_formula' => $findExpenseInfoWillStore->getFormula(),
        ]);

        return redirect()->route('dashboard.room.expenses');
    }


    public function edit($id)
    {
        $showableExpense = Expense::where('id', $id)->get()->first();

        return view('dashboard.expenses-edit', ['pageName' => 'Редактирование товара', 'currentExpense' => $showableExpense]);
    }

    public function update($id)
    {

    }

    public function remove($id)
    {
        $thisRoomExpenses = Expense::where('room_id', session()->get('current_room'))->get();

        DB::table('member_expenses')->where('expense_id', $id)->delete();
        DB::table('expenses')->where('id', $id)->delete();

        return redirect()->route('dashboard.room.expenses');
    }
}