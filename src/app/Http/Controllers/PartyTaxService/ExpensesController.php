<?php

namespace App\Http\Controllers\PartyTaxService;

use App\Models\Expense;
use App\Models\RoomMember;
use App\Models\MemberExpense;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Actions\Partytax\FindExpenseMultiplier;

class ExpensesController extends Controller
{    
    public function index()
    {
        $thisRoomExpenses = Expense::where('room_id', session()->get('current_room'))->get();

        return view('partytax.rooms.expenses',  ['pageName' => 'Траты', 'RoomExpenses' => $thisRoomExpenses]);
    }

    public function create()
    {
        return view('partytax.rooms.expenses-add', ['pageName' => 'Добавить трату']);
    }

    public function store(FindExpenseMultiplier $findExpenseMultiplier)
    {
        Expense::create([
            'name' => $_POST['expense-name'],
            'room_id' => session()->get('current_room'),
            'price' => $_POST['price'],
            'count' => $_POST['expense-count'],
        ]);

        return redirect()->route('partytax.room.expenses');
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




        return view('partytax.rooms.expenses-show', ['pageName' => 'Редактирование товара', 'currentExpense' => $showableExpense, 'contributorsList' => $contributorsList]);
    }
}