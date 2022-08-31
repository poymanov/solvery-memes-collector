<?php

namespace App\Services\VkParsingSource\Exceptions;

use Exception;

class VkParsingSourceUpdateFailedException extends Exception
{
    public function __construct(int $id)
    {
        $message = 'Failed to update vk source, id: ' . $id;

        parent::__construct($message);
    }
}
