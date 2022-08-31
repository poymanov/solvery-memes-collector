<?php

namespace App\Services\VkParsingSource\Exceptions;

use Exception;

class VkParsingSourceNotFoundException extends Exception
{
    /**
     * @param int $id
     */
    public function __construct(int $id)
    {
        $message = 'Vk parsing source not found: ' . $id;

        parent::__construct($message);
    }
}
