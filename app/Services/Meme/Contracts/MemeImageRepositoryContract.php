<?php

namespace App\Services\Meme\Contracts;

use App\Services\Meme\Exceptions\MemeImageCreateFailedException;
use App\Services\Meme\Exceptions\MemeImageStoreFileFailedException;

interface MemeImageRepositoryContract
{
    /**
     * Создание объекта изображения
     *
     * @param int   $memeId
     * @param array $images
     *
     * @return void
     * @throws MemeImageCreateFailedException
     * @throws MemeImageStoreFileFailedException
     */
    public function create(int $memeId, array $images): void;
}
