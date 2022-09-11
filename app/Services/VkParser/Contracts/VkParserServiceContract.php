<?php

namespace App\Services\VkParser\Contracts;

use App\Services\VkParser\Dtos\VkPostDto;
use App\Services\VkParser\Exceptions\RequiredPropertyUndefinedException;

interface VkParserServiceContract
{
    /**
     * @param string $url
     *
     * @return VkPostDto[]
     * @throws RequiredPropertyUndefinedException
     */
    public function getPostsByUrl(string $url): array;
}
