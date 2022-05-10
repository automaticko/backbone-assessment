<?php

namespace App\Services\Place\Exceptions;

use Exception;

class InvalidProviderDataException extends Exception
{
    public function __construct()
    {
        parent::__construct('Invalid provider data');
    }
}
