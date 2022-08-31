<?php

namespace App\Services\VkParsingSource\Repositories;

use App\Models\VkParsingSource;
use App\Services\VkParsingSource\Contracts\VkParsingSourceRepositoryContract;
use App\Services\VkParsingSource\Dtos\VkParsingSourceCreateDto;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceCreateFailedException;

class VkParsingSourceRepository implements VkParsingSourceRepositoryContract
{
    /**
     * @inheritDoc
     */
    public function create(VkParsingSourceCreateDto $vkSourceCreateDto): void
    {
        $vkSource        = new VkParsingSource();
        $vkSource->title = $vkSourceCreateDto->title;
        $vkSource->url   = $vkSourceCreateDto->url;

        if (!$vkSource->save()) {
            throw new VkParsingSourceCreateFailedException();
        }
    }
}