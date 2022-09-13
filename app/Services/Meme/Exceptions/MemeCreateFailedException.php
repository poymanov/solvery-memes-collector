<?php

namespace App\Services\Meme\Exceptions;

use Exception;

class MemeCreateFailedException extends Exception
{
    public function __construct()
    {
        $message = 'Failed to create meme';

        parent::__construct($message);
    }
}
