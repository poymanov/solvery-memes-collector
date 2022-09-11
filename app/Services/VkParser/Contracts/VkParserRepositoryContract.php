<?php

namespace App\Services\VkParser\Contracts;

use App\Services\VkParser\Dtos\VkPostDto;
use App\Services\VkParser\Exceptions\RequiredPropertyUndefinedException;

interface VkParserRepositoryContract
{
    /**
     * @param string $parsingDomain
     *
     * @return VkPostDto[]
     * @throws RequiredPropertyUndefinedException
     */
    public function getPostsByUrl(string $parsingDomain): array;
}
