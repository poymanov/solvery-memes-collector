<?php

namespace App\Services\VkParsingSource\Repositories;

use App\Models\VkParsingSource;
use App\Services\VkParsingSource\Contracts\VkParsingSourceDtoFactoryContract;
use App\Services\VkParsingSource\Contracts\VkParsingSourceRepositoryContract;
use App\Services\VkParsingSource\Dtos\VkParsingSourceCreateUpdateDto;
use App\Services\VkParsingSource\Dtos\VkParsingSourceDto;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceCreateFailedException;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceDeleteFailedException;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceNotFoundException;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceUpdateFailedException;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceUpdateParsingStatusException;
use DateTime;

class VkParsingSourceRepository implements VkParsingSourceRepositoryContract
{
    public function __construct(private readonly VkParsingSourceDtoFactoryContract $vkParsingSourceDtoFactory)
    {
    }

    /**
     * @inheritDoc
     */
    public function create(VkParsingSourceCreateUpdateDto $vkSourceCreateDto): void
    {
        $vkSource        = new VkParsingSource();
        $vkSource->title = $vkSourceCreateDto->title;
        $vkSource->url   = $vkSourceCreateDto->url;

        if (!$vkSource->save()) {
            throw new VkParsingSourceCreateFailedException();
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, VkParsingSourceCreateUpdateDto $vkSourceUpdateDto): void
    {
        $vkSource        = $this->findModelById($id);
        $vkSource->title = $vkSourceUpdateDto->title;
        $vkSource->url   = $vkSourceUpdateDto->url;

        if (!$vkSource->save()) {
            throw new VkParsingSourceUpdateFailedException($id);
        }
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): void
    {
        $vkSource = $this->findModelById($id);

        if (!$vkSource->delete()) {
            throw new VkParsingSourceDeleteFailedException($id);
        }
    }

    /**
     * @inheritDoc
     */
    public function findOneById(int $id): VkParsingSourceDto
    {
        return $this->vkParsingSourceDtoFactory->createFromModel($this->findModelById($id));
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        return $this->vkParsingSourceDtoFactory->createFromModelsList(VkParsingSource::all());
    }

    /**
     * @inheritDoc
     */
    public function updateParsingStatus(int $id, string $parsingStatus, DateTime $date): void
    {
        $vkParsingSource = $this->findModelById($id);
        $vkParsingSource->id = $id;
        $vkParsingSource->parsing_status = $parsingStatus;
        $vkParsingSource->parsed_at = $date->format('Y-m-d H:i:s');

        if (!$vkParsingSource->save()) {
            throw new VkParsingSourceUpdateParsingStatusException($id, $parsingStatus);
        }
    }

    /**
     * Получение модели по ID
     *
     * @param int $id
     *
     * @return VkParsingSource
     * @throws VkParsingSourceNotFoundException
     */
    private function findModelById(int $id): VkParsingSource
    {
        $vkParsingSource = VkParsingSource::find($id);

        if (!$vkParsingSource) {
            throw new VkParsingSourceNotFoundException($id);
        }

        return $vkParsingSource;
    }
}
