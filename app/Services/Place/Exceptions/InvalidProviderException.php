<?php

namespace App\Services\Place\Exceptions;

use Exception;

class InvalidProviderException extends Exception
{
    public function __construct()
    {
        parent::__construct('Invalid provider');
    }
}
