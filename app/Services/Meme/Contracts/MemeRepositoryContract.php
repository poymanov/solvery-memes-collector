<?php

namespace App\Services\Meme\Contracts;

use App\Services\Meme\Dtos\MemeCreateDto;
use App\Services\Meme\Exceptions\MemeCreateFailedException;

interface MemeRepositoryContract
{
    /**
     * Создание объекта с мемом
     *
     * @param MemeCreateDto $memeCreateDto
     *
     * @return void
     * @throws MemeCreateFailedException
     */
    public function create(MemeCreateDto $memeCreateDto): void;

    /**
     * Получение всех мемов
     *
     * @return array
     */
    public function findAll(): array;

    /**
     * Получение списка ID существующих из представленных мемов
     *
     * @param string $sourceType
     * @param string $sourceAlias
     * @param array  $externalIds
     *
     * @return array
     */
    public function getExistedExternalIds(string $sourceType, string $sourceAlias, array $externalIds): array;
}
