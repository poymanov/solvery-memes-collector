<?php

namespace App\Enums;

enum ParsingStatusEnum: string
{
    case NOT_PARSED = 'not_parsed';

    case SUCCESS = 'success';

    case FAILED = 'failed';

    public function title(): string
    {
        return match ($this) {
            self::NOT_PARSED => 'Not Parsed',
            self::SUCCESS => 'Success',
            self::FAILED => 'Failed',
        };
    }
}
