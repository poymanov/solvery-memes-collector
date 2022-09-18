<?php

namespace App\Services\Meme\Exceptions;

use Exception;

class MemeImageCreateFailedException extends Exception
{
    public function __construct(int $memeId)
    {
        $message = "Failed to create meme image: {$memeId}";

        parent::__construct($message);
    }
}
