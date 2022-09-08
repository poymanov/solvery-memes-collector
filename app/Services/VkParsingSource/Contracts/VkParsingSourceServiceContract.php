<?php

namespace App\Services\VkParsingSource\Contracts;

use App\Enums\ParsingStatusEnum;
use App\Services\VkParsingSource\Dtos\VkParsingSourceDto;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceCreateFailedException;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceDeleteFailedException;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceNotFoundException;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceUpdateFailedException;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceUpdateParsingStatusException;

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
     * Удаление источника парсинга VK
     *
     * @param int $id
     *
     * @return void
     * @throws VkParsingSourceDeleteFailedException
     * @throws VkParsingSourceNotFoundException
     */
    public function delete(int $id): void;

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

    /**
     * Обновление статуса парсинга
     *
     * @param int               $id
     * @param ParsingStatusEnum $parsingStatus
     *
     * @return void
     * @throws VkParsingSourceNotFoundException
     * @throws VkParsingSourceUpdateParsingStatusException
     */
    public function updateParsingStatus(int $id, ParsingStatusEnum $parsingStatus): void;
}
