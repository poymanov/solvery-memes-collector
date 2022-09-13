<?php

namespace App\Services\VkParsingSource\Dtos;

use App\Enums\ParsingStatusEnum;
use DateTime;

class VkParsingSourceDto
{
    public int $id;

    public string $title;

    public string $url;

    public ParsingStatusEnum $parsingStatus;

    public ?string $parsingStatusDescription;

    public ?DateTime $parsedAt;
}
