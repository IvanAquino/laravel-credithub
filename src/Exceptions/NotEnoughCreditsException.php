<?php

namespace IvanAquino\LaravelCredithub\Exceptions;

use Exception;

class NotEnoughCreditsException extends Exception
{
    public function __construct($message = 'Not enough credits', $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
