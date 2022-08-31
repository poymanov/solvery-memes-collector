<?php

namespace App\Services\VkParsingSource\Contracts;

use App\Services\VkParsingSource\Dtos\VkParsingSourceCreateDto;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceCreateFailedException;

interface VkParsingSourceRepositoryContract
{
    /**
     * Создание источника VK
     *
     * @param VkParsingSourceCreateDto $vkSourceCreateDto
     *
     * @return void
     * @throws VkParsingSourceCreateFailedException
     */
    public function create(VkParsingSourceCreateDto $vkSourceCreateDto): void;
}
