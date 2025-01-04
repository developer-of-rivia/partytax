<?php

namespace App\Exceptions;

use Exception;

class FindExpenseMultiplierException extends Exception
{
    public function render()
    {
        return 'Не задано произведение, множитель или они вместе';
    }
}
