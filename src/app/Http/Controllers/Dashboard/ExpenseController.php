<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Expense;
use App\Models\RoomMember;
use Illuminate\Http\Request;
use App\Models\MemberExpense;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Actions\Dashboard\FindExpenseInfoWillStore;
use App\Http\Requests\Requests\Expense\ExpenseStoreRequest;

class ExpenseController extends Controller
{   
    /**
     * Display expenses
     */
    public function index()
    {
        $thisRoomExpenses = Expense::where('room_id', session()->get('current_room'))->get();

        return view('dashboard.expenses',  ['pageName' => 'Траты', 'RoomExpenses' => $thisRoomExpenses]);
    }

    /**
     * Display expense create page
     */
    public function create()
    {
        return view('dashboard.expenses-add', ['pageName' => 'Добавить трату']);
    }

    /**
     * Store newly created expense
     */
    public function store(ExpenseStoreRequest $request, FindExpenseInfoWillStore $findExpenseInfoWillStore)
    {
        $findExpenseInfoWillStore->setPostData($request->all());
        $findExpenseInfoWillStore->handle();

        Expense::create([
            'name' => $request->get('name'),
            'room_id' => session()->get('current_room'),
            'price' => $findExpenseInfoWillStore->getPrice(),
            'count' => $request->get('count'),
            'current_formula' => $findExpenseInfoWillStore->getFormula(),
        ]);

        return redirect()->route('dashboard.room.expenses');
    }

    /**
     * Display expense edit page
     */
    public function edit($id)
    {
        $showableExpense = Expense::where('id', $id)->get()->first();

        if($showableExpense->current_formula == "expenseOne"){
            $showableExpense->price = $showableExpense->price / $showableExpense->count;
        }

        return view('dashboard.expenses-edit', ['pageName' => 'Редактирование товара', 'currentExpense' => $showableExpense]);
    }

    /**
     * Update expense
     */
    public function update(Request $request, $id, FindExpenseInfoWillStore $findExpenseInfoWillStore)
    {   
        $findExpenseInfoWillStore->setPostData($request->all());
        $findExpenseInfoWillStore->handle();

        $expense = Expense::findOrFail($id);
        $expense->update([
            'name' => $_POST['name'],
            'price' => $findExpenseInfoWillStore->getPrice(),
            'count' => $_POST['count'],
            'current_formula' => $findExpenseInfoWillStore->getFormula(),
        ]);

        return redirect()->route('dashboard.room.expenses');
    }

    /**
     * Destroy expense
     */
    public function remove($id)
    {
        $thisRoomExpenses = Expense::where('room_id', session()->get('current_room'))->get();

        DB::table('member_expenses')->where('expense_id', $id)->delete();
        DB::table('expenses')->where('id', $id)->delete();

        return redirect()->route('dashboard.room.expenses');
    }
}