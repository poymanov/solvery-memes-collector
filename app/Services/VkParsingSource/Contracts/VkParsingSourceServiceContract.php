<?php

namespace App\Services\VkParsingSource\Contracts;

use App\Services\VkParsingSource\Dtos\VkParsingSourceDto;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceCreateFailedException;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceNotFoundException;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceUpdateFailedException;

interface VkParsingSourceServiceContract
{
    /**
     * Создание источника парсинга VK
     *
     * @param string $title
     * @param string $url
     *
     * @return void
     * @throws VkParsingSourceCreateFailedException
     */
    public function create(string $title, string $url): void;

    /**
     * Обновление источника парсинга VK
     *
     * @param int    $id
     * @param string $title
     * @param string $url
     *
     * @return void
     * @throws VkParsingSourceNotFoundException
     * @throws VkParsingSourceUpdateFailedException
     */
    public function update(int $id, string $title, string $url): void;

    /**
     * Получение источника парсинга по ID
     *
     * @param int $id
     *
     * @return VkParsingSourceDto
     * @throws VkParsingSourceNotFoundException
     */
    public function findOneById(int $id): VkParsingSourceDto;

    /**
     * Получение списка источник парсинга VK
     *
     * @return VkParsingSourceDto[]
     */
    public function findAll(): array;
}
