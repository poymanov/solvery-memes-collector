<?php

namespace App\Services\VkParsingSource\Contracts;

use App\Models\VkParsingSource;
use App\Services\VkParsingSource\Dtos\VkParsingSourceDto;
use Illuminate\Database\Eloquent\Collection;

interface VkParsingSourceDtoFactoryContract
{
    /**
     * @param VkParsingSource $vkParsingSource
     *
     * @return VkParsingSourceDto
     */
    public function createFromModel(VkParsingSource $vkParsingSource): VkParsingSourceDto;

    /**
     * @param Collection $models
     *
     * @return VkParsingSourceDto[]
     */
    public function createFromModelsList(Collection $models): array;
}
