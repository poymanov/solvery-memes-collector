<?php

namespace App\Services\VkParsingSource\Factories;

use App\Enums\ParsingStatusEnum;
use App\Models\VkParsingSource;
use App\Services\VkParsingSource\Contracts\VkParsingSourceDtoFactoryContract;
use App\Services\VkParsingSource\Dtos\VkParsingSourceDto;
use DateTime;
use Illuminate\Database\Eloquent\Collection;

class VkParsingSourceDtoFactory implements VkParsingSourceDtoFactoryContract
{
    /**
     * @param VkParsingSource $vkParsingSource
     *
     * @return VkParsingSourceDto
     */
    public function createFromModel(VkParsingSource $vkParsingSource): VkParsingSourceDto
    {
        $dto                = new VkParsingSourceDto();
        $dto->id            = $vkParsingSource->id;
        $dto->title         = $vkParsingSource->title;
        $dto->url           = $vkParsingSource->url;
        $dto->parsingStatus = ParsingStatusEnum::from($vkParsingSource->parsing_status);
        $dto->parsedAt      = $vkParsingSource->parsed_at ? new DateTime($vkParsingSource->parsed_at) : null;

        return $dto;
    }

    /**
     * @param Collection $models
     *
     * @return VkParsingSourceDto[]
     */
    public function createFromModelsList(Collection $models): array
    {
        $dtos = [];

        foreach ($models as $model) {
            $dtos[] = $this->createFromModel($model);
        }

        return $dtos;
    }
}
