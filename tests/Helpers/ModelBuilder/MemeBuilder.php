<?php

namespace Tests\Helpers\ModelBuilder;

use App\Models\Meme;

class MemeBuilder
{
    /**
     * Создание сущности {@see Meme}
     *
     * @param array $params Параметры нового объекта
     *
     * @return Meme
     */
    public function create(array $params = []): Meme
    {
        return Meme::factory()->createOneQuietly($params);
    }
}
