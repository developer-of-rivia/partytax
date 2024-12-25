<?php
namespace App\Actions\Partytax;

use App\Exceptions\FindExpenseMultiplierException;
use App\Models\Room;


class FindExpenseMultiplier
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
            throw new FindExpenseMultiplierException();
        } else {
            return $this->knownMultiplier;
        }
    }

    public function handle()
    {
        if($this->expenseComposition == null || $this->knownMultiplier == null){
            throw new FindExpenseMultiplierException();
        } else {
            $this->result = $this->expenseComposition / $this->knownMultiplier;
        }
    }

    public function getResult()
    {
        if($this->result == null){
            throw new FindExpenseMultiplierException();
        } else {
            return $this->result;
        }
    }

}