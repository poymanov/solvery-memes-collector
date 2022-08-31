<?php

namespace Tests\Helpers\ModelBuilder\ParsingSourceBuilder;

use App\Models\VkParsingSource;

class VkBuilder
{
    /**
     * Создание сущности {@see VkParsingSource}
     *
     * @param array $params Параметры нового объекта
     *
     * @return VkParsingSource
     */
    public function create(array $params = []): VkParsingSource
    {
        return VkParsingSource::factory()->createOneQuietly($params);
    }

    /**
     * Подготовка сущности {@see VkParsingSource}
     *
     * @param array $params Параметры нового объекта
     *
     * @return VkParsingSource
     */
    public function make(array $params = []): VkParsingSource
    {
        return VkParsingSource::factory()->makeOne($params);
    }
}
