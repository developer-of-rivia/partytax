<?php


    public function calculateRoomMemberExpenses()
    {
        // Инициализация массива результатов
        $allMembersResults = [];

        // Получаем все траты и соответствующие цены заранее
        $expenses = $this->getUserExpenses();
        $expensePrices = $this->getExpensePrices($expenses);

        // Начинаем по одному выбирать участников комнаты
        foreach($this->getRoomMembers() as $member) {
            // Получаем результаты для конкретного участника
            $allMembersResults[$member->name] = $this->calculateMemberExpense($member, $expenses, $expensePrices);
        }

        return $allMembersResults;
    }


    private function calculateMemberExpense($member, $expenses, $expensePrices)
    {
        $hisResult = 0;

        foreach($expenses as $expense) {
            $currentExpensePrice = $expensePrices[$expense->expense_id];
            $contributorsCount = $this->getContributorsCount($expense->expense_id);
            
            // Избегаем деления на ноль
            if ($contributorsCount > 0) {
                $contributorsPart = $currentExpensePrice / $contributorsCount;
                // Используем number_format только один раз перед окончательным результатом
                $hisResult += $contributorsPart;
            }
        }

        return number_format($hisResult);
    }