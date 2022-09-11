<?php

namespace App\Services\VkParser\Exceptions;

use Exception;

class RequiredPropertyUndefinedException extends Exception
{
    public function __construct(string $property)
    {
        $message = 'Required property undefined: ' . $property;

        parent::__construct($message);
    }
}
