<?php

namespace App\Services\Meme\Exceptions;

use Exception;

class MemeImageStoreFileDetectExtensionFailedException extends Exception
{
    public function __construct(string $image)
    {
        $message = "Detect file extension failed: $image";

        parent::__construct($message);
    }
}
