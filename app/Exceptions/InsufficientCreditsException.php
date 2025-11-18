<?php

namespace App\Exceptions;

use Exception;

class InsufficientCreditsException extends Exception
{
    public function __construct(
        $message = "Not enough credits.",
        $statusCode = 400
    ) {
        parent::__construct($statusCode, $message);
    }
}
