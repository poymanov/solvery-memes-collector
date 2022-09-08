<?php

namespace App\Services\VkParsingSource\Exceptions;

use Exception;

class VkParsingSourceUpdateParsingStatusException extends Exception
{
    public function __construct(int $id, string $parsingStatus)
    {
        $message = "Failed to update vk source parsing status, id: $id, parsing status: $parsingStatus";

        parent::__construct($message);
    }
}
