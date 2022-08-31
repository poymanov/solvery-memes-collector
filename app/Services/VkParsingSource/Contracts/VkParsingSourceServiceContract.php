<?php

namespace App\Services\VkParsingSource\Contracts;

use App\Services\VkParsingSource\Dtos\VkParsingSourceDto;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceCreateFailedException;

interface VkParsingSourceServiceContract
{
    /**
     * Создание источника VK
     *
     * @param string $title
     * @param string $url
     *
     * @return void
     * @throws VkParsingSourceCreateFailedException
     */
    public function create(string $title, string $url): void;

    /**
     * Получение списка источник парсинга VK
     *
     * @return VkParsingSourceDto[]
     */
    public function findAll(): array;
}
