<?php
namespace App\Actions\Partytax;

use App\Exceptions\FindExpensePriceException;
use App\Models\Room;


class FindExpensePrice
{
    private $expenseComposition;
    private $knownMultiplier;
    private $result;

    public function setComposition($expenseComposition)
    {
        $this->expenseComposition = $expenseComposition;
    }

    public function setKnownMultiplier($knownMultiplier)
    {
        $this->knownMultiplier = $knownMultiplier;
    }

    public function getKnownMultiplier()
    {
        if($this->knownMultiplier == null){
            throw new FindExpensePriceException();
        } else {
            return $this->knownMultiplier;
        }
    }

    public function handle()
    {
        if($this->expenseComposition == null || $this->knownMultiplier == null){
            throw new FindExpensePriceException();
        } else {
            $this->result = $this->expenseComposition / $this->knownMultiplier;
        }
    }

    public function getResult()
    {
        if($this->result == null){
            throw new FindExpensePriceException();
        } else {
            return $this->result;
        }
    }

}