<?php

namespace App\Services\Meme\Exceptions;

use Exception;

class MemeImageStoreFileFailedException extends Exception
{
    public function __construct(int $memeId, string $description)
    {
        $message = "Failed to store image for meme (ID $memeId): $description";

        parent::__construct($message);
    }
}
