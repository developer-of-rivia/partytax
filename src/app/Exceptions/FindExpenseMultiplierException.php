<?php

namespace App\Exceptions;

use Exception;

class FindExpensePriceException extends Exception
{
    public function render()
    {
        return 'Не задано произведение, множитель или они вместе';
    }
}
