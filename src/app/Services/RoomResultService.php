<?php

namespace App\Services;

use App\Models\Expense;
use App\Models\RoomMember;
use App\Models\MemberExpense;

class RoomResultService
{
    private int $currentRoomID;

    private array $allMembersResults = [];

    /**
     * interfaces
     */

    public function getMemberResults(): array
    {
        return $this->allMembersResults;
    }

    public function setCurrentRoom($roomID): void
    {
        $this->currentRoomID = $roomID;
    }

    public function prepareResults()
    {
        $allMembers = RoomMember::where('room_id', $this->currentRoomID)->get();

        foreach($allMembers as $member){
            $this->collectMemberResults($member, $this->calculateMemberResult($member->id));
        }
    }

    /**
     * methods
     */

    /**
     * В общий массив с результатами кладёт имя участника и его результат, 
     * который считается через calculateMemberResult()
     */
    private function collectMemberResults($member, $currentResult)
    {
        $this->allMembersResults[$member->name] = $currentResult;
    }


    /**
     * Берёт все траты участника и считает сколько он должен всего
     * Каждая трата обрабатывается через функции getExpenseInfo, затем calculateContributorsPart
     * Берётся человек, который оплатил у каждой траты и нужная часть, посчитанная через calculateContributorsPart
     * Идёт только к нему
     */
    private function calculateMemberResult($memberID)
    {
        $hisExpenses = MemberExpense::where('member_id', $memberID)->get();
        $hisResult = [];

        foreach($hisExpenses as $expense){
            $thisExpenseInfo = $this->getExpenseInfo($expense);
            $contributorsPart = $this->calculateContributorsPart($thisExpenseInfo);

            $hisResult[$thisExpenseInfo['payer']] += $contributorsPart;
        }

        return $hisResult;
    }

    /**
     * Берёт всю информацию о трате
     */
    private function getExpenseInfo($expense): array
    {
        $expenseInfo = [];

        $expenseInfo['price'] = Expense::where('id', $expense->expense_id)->get()->first()->price;
        $expenseInfo['contributorsCount'] = MemberExpense::where('expense_id', $expense->expense_id)->get()->count();
        $expenseInfo['payer'] = Expense::where('id', $expense->expense_id)->get()->first()->payer;

        return $expenseInfo;
    }

    /**
     * Берёт трату и возвращает часть, которую должен скинуть
     * каждый 
     */
    private function calculateContributorsPart($expenseInfo): int
    {
        $contributorsPart = $expenseInfo['price'] / $expenseInfo['contributorsCount'];
        $contributorsPart = (int)$contributorsPart;

        return $contributorsPart;
    }

    /**
     * Берёт трату 
     */
    private function foo()
    {

    }
}