<?php

namespace App\Services\VkParser\Contracts;

use App\Services\Meme\Exceptions\MemeCreateFailedException;
use App\Services\VkParser\Dtos\VkPostDto;
use App\Services\VkParser\Exceptions\RequiredPropertyUndefinedException;
use App\Services\VkParsingSource\Dtos\VkParsingSourceDto;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceNotFoundException;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceUpdateParsingStatusException;
use Throwable;

interface VkParserServiceContract
{
    /**
     * @param string $url
     *
     * @return VkPostDto[]
     * @throws RequiredPropertyUndefinedException
     */
    public function getPostsByUrl(string $url): array;

    /**
     * Парсинг источника
     *
     * @param VkParsingSourceDto $vkParsingSource
     *
     * @return void
     * @throws RequiredPropertyUndefinedException
     * @throws Throwable
     * @throws MemeCreateFailedException
     * @throws VkParsingSourceNotFoundException
     * @throws VkParsingSourceUpdateParsingStatusException
     */
    public function parseSource(VkParsingSourceDto $vkParsingSource);
}
