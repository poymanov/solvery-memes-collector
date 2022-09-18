<?php

namespace App\Services\Meme\Dtos;

class MemeCreateDto
{
    public string $sourceType;

    public string $sourceAlias;

    public string $externalId;

    public ?string $text;

    public array $images;
}
