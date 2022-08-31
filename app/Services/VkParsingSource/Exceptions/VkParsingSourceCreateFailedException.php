<?php

namespace App\Services\VkParsingSource\Exceptions;

use Exception;

class VkParsingSourceCreateFailedException extends Exception
{
    public function __construct()
    {
        $message = 'Failed to create vk source';

        parent::__construct($message);
    }
}
