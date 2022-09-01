<?php

namespace App\Services\VkParsingSource\Exceptions;

use Exception;

class VkParsingSourceDeleteFailedException extends Exception
{
    public function __construct(int $id)
    {
        $message = 'Failed to delete vk source, id: ' . $id;

        parent::__construct($message);
    }
}
