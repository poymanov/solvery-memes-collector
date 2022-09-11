<?php

namespace App\Services\VkParser\Exceptions;

use Exception;

class RequestFailedException extends Exception
{
    public function __construct(?string $message)
    {
        $message = $message ?? 'Something went wrong.';

        parent::__construct($message);
    }
}
