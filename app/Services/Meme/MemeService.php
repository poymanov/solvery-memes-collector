<?php

namespace App\Services\Meme;

use App\Enums\MemeSourceTypeEnum;
use App\Services\Meme\Contracts\MemeRepositoryContract;
use App\Services\Meme\Contracts\MemeServiceContract;
use App\Services\Meme\Dtos\MemeCreateDto;

class MemeService implements MemeServiceContract
{
    public function __construct(private readonly MemeRepositoryContract $memeRepository)
    {
    }

    /**
     * @inheritDoc
     */
    public function create(MemeSourceTypeEnum $sourceType, string $sourceAlias, string $externalId, ?string $text): void
    {
        $memeCreateDto              = new MemeCreateDto();
        $memeCreateDto->sourceType  = $sourceType->value;
        $memeCreateDto->sourceAlias = $sourceAlias;
        $memeCreateDto->externalId  = $externalId;
        $memeCreateDto->text        = $text;

        $this->memeRepository->create($memeCreateDto);
    }

    /**
     * @inheritDoc
     */
    public function getNotExistedExternalIds(MemeSourceTypeEnum $sourceType, string $sourceAlias, array $externalIds): array
    {
        $existedExternalIds = $this->memeRepository->getExistedExternalIds($sourceType->value, $sourceAlias, $externalIds);

        if (empty($existedExternalIds)) {
            return $externalIds;
        }

        return array_diff($externalIds, $existedExternalIds);
    }
}
