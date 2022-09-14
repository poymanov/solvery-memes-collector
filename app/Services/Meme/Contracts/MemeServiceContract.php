<?php

namespace App\Services\Meme\Contracts;

use App\Enums\MemeSourceTypeEnum;
use App\Services\Meme\Exceptions\MemeCreateFailedException;

interface MemeServiceContract
{
    /**
     * @param MemeSourceTypeEnum $sourceType
     * @param string             $sourceAlias
     * @param string             $externalId
     * @param string|null        $text
     *
     * @return void
     * @throws MemeCreateFailedException
     */
    public function create(MemeSourceTypeEnum $sourceType, string $sourceAlias, string $externalId, ?string $text): void;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * Получение списка ID несуществующих из представленных мемов
     *
     * @param MemeSourceTypeEnum $sourceType
     * @param string             $sourceAlias
     * @param array              $externalIds
     *
     * @return array
     */
    public function getNotExistedExternalIds(MemeSourceTypeEnum $sourceType, string $sourceAlias, array $externalIds): array;
}
