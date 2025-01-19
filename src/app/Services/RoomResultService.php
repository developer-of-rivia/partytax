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
     * 
     */

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

    private function getExpenseInfo($expense): array
    {
        $expenseInfo = [];

        $expenseInfo['price'] = Expense::where('id', $expense->expense_id)->get()->first()->price;
        $expenseInfo['contributorsCount'] = MemberExpense::where('expense_id', $expense->expense_id)->get()->count();

        return $expenseInfo;
    }

    private function calculateContributorsPart($expenseInfo): int
    {
        $contributorsPart = $expenseInfo['price'] / $expenseInfo['contributorsCount'];
        $contributorsPart = (int)$contributorsPart;

        return $contributorsPart;
    }
}