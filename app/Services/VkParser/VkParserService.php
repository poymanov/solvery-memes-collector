<?php

namespace App\Services\VkParser;

use App\Services\VkParser\Contracts\VkParserRepositoryContract;
use App\Services\VkParser\Contracts\VkParserServiceContract;

class VkParserService implements VkParserServiceContract
{
    public function __construct(private readonly VkParserRepositoryContract $vkParserRepository)
    {
    }

    /**
     * @inheritDoc
     */
    public function getPostsByUrl(string $url): array
    {
        $parsingDomain = str_replace('https://vk.com/', '', $url);

        return $this->vkParserRepository->getPostsByUrl($parsingDomain);
    }
}
