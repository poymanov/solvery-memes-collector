<?php

namespace App\Services\VkParsingSource;

use App\Services\VkParsingSource\Contracts\VkParsingSourceRepositoryContract;
use App\Services\VkParsingSource\Contracts\VkParsingSourceServiceContract;
use App\Services\VkParsingSource\Dtos\VkParsingSourceCreateUpdateDto;
use App\Services\VkParsingSource\Dtos\VkParsingSourceDto;

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
        $vkSourceCreateDto        = new VkParsingSourceCreateUpdateDto();
        $vkSourceCreateDto->title = $title;
        $vkSourceCreateDto->url   = $url;

        $this->vkSourceRepository->create($vkSourceCreateDto);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, string $title, string $url): void
    {
        $vkSourceUpdateDto        = new VkParsingSourceCreateUpdateDto();
        $vkSourceUpdateDto->title = $title;
        $vkSourceUpdateDto->url   = $url;

        $this->vkSourceRepository->update($id, $vkSourceUpdateDto);
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): void
    {
        $this->vkSourceRepository->delete($id);
    }

    /**
     * @inheritDoc
     */
    public function findOneById(int $id): VkParsingSourceDto
    {
        return $this->vkSourceRepository->findOneById($id);
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        return $this->vkSourceRepository->findAll();
    }
}
