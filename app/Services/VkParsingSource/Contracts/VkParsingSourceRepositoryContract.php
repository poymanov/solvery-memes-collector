<?php

namespace App\Services\VkParsingSource\Contracts;

use App\Services\VkParsingSource\Dtos\VkParsingSourceCreateUpdateDto;
use App\Services\VkParsingSource\Dtos\VkParsingSourceDto;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceCreateFailedException;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceDeleteFailedException;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceNotFoundException;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceUpdateFailedException;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceUpdateParsingStatusException;
use DateTime;

interface VkParsingSourceRepositoryContract
{
    /**
     * Создание источника парсинга VK
     *
     * @param VkParsingSourceCreateUpdateDto $vkSourceCreateDto
     *
     * @return void
     * @throws VkParsingSourceCreateFailedException
     */
    public function create(VkParsingSourceCreateUpdateDto $vkSourceCreateDto): void;

    /**
     * Обновление источника парсинга VK
     *
     * @param int                            $id
     * @param VkParsingSourceCreateUpdateDto $vkSourceCreateUpdateDto
     *
     * @return void
     * @throws VkParsingSourceNotFoundException
     * @throws VkParsingSourceUpdateFailedException
     */
    public function update(int $id, VkParsingSourceCreateUpdateDto $vkSourceCreateUpdateDto): void;

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
     * Обновление статуса парсинга источника парсинга VK
     *
     * @param int         $id
     * @param string      $parsingStatus
     * @param string|null $parsingStatusDescription
     * @param DateTime    $date
     *
     * @return void
     * @throws VkParsingSourceNotFoundException
     * @throws VkParsingSourceUpdateParsingStatusException
     */
    public function updateParsingStatus(int $id, string $parsingStatus, ?string $parsingStatusDescription, DateTime $date): void;
}
