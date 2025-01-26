<?php
namespace App\Actions\Dashboard;

use App\Exceptions\FindExpensePriceException;
use App\Models\Room;


class FindExpenseInfoWillStore
{
    private array $postData;
    private string $formula;
    private int $price;

    public function getFormula(): string
    {
        return $this->formula;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPostData($postData): void
    {
        $this->postData = $postData;
    }

    public function handle(): void
    {
        if($this->postData['expenseType'] == 'expenseOne')
        {
            $this->formula = 'expenseOne';
            $this->price = $this->postData['price'] * $this->postData['count'];
        }
        elseif($this->postData['expenseType'] == 'expenseAll')
        {
            $this->formula = 'expenseAll';
            $this->price = $this->postData['price'];
        }
    }
}