<?php

namespace App\Services\VkParsingSource;

use App\Services\VkParsingSource\Contracts\VkParsingSourceRepositoryContract;
use App\Services\VkParsingSource\Contracts\VkParsingSourceServiceContract;
use App\Services\VkParsingSource\Dtos\VkParsingSourceCreateDto;

class VkParsingSourceService implements VkParsingSourceServiceContract
{
    public function __construct(private readonly VkParsingSourceRepositoryContract $vkSourceRepository)
    {
    }

    /**
     * @inheritDoc
     */
    public function create(string $title, string $url): void
    {
        $vkSourceCreateDto = new VkParsingSourceCreateDto();
        $vkSourceCreateDto->title = $title;
        $vkSourceCreateDto->url = $url;

        $this->vkSourceRepository->create($vkSourceCreateDto);
    }
}
