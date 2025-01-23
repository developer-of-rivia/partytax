<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Room;
use App\Models\Expense;
use App\Models\RoomMember;
use App\Http\Controllers\Controller;
use App\Models\MemberExpense;



class RoomController extends Controller
{
    public function indexResults()
    {
        $this->prepareResults();
        return view('dashboard.results',  ['pageName' => 'Результаты', 'allMembersResults' => $this->getMemberResults()]);
    }

    public function getMemberResults(): array
    {
        return $this->allMembersResults;
    }

    /**
     * ----------------------------------------------
     */

    private array $allMembersResults = [];

    private function prepareResults()
    {
        $allMembers = RoomMember::where('room_id', session()->get('current_room'))->get();

        foreach($allMembers as $member){
            $this->collectMemberResults($member, $this->calculateMemberResult($member->id));
        }

    }

    private function collectMemberResults($member, $currentResult)
    {
        $this->allMembersResults[$member->name] = $currentResult;
    }


    private function calculateMemberResult($memberID)
    {
        $hisExpenses = MemberExpense::where('member_id', $memberID)->get();
        $hisResult = 0;

        foreach($hisExpenses as $expense){
            $thisExpenseInfo = $this->getExpenseInfo($expense);
            $contributorsPart = $this->calculateContributorsPart($thisExpenseInfo);

            $hisResult += $contributorsPart;
        }

        return $hisResult;
    }


    private function getExpenseInfo($expense)
    {
        $expenseInfo = [];

        $expenseInfo['price'] = Expense::where('id', $expense->expense_id)->get()->first()->price;
        $expenseInfo['contributorsCount'] = MemberExpense::where('expense_id', $expense->expense_id)->get()->count();

        return $expenseInfo;
    }


    private function calculateContributorsPart($expenseInfo)
    {
        $contributorsPart = $expenseInfo['price'] / $expenseInfo['contributorsCount'];
        $contributorsPart = number_format($contributorsPart);

        return $contributorsPart;
    }
}