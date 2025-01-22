<?php
namespace App\Actions\Dashboard;

use App\Exceptions\FindExpensePriceException;
use App\Models\Room;


class FindExpensePriceWillStore
{
    public function handle($postData): int
    {
        if($postData['expenseType'] == 'expenseOne')
        {
            return $postData['price'] * $postData['expense-count'];
        }
        elseif($postData['expenseType'] == 'expenseAll')
        {
            return $postData['price'];
        }
    }
}