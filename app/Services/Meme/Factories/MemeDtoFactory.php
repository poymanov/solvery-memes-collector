<?php

namespace App\Services\Meme\Factories;

use App\Models\Meme;
use App\Services\Meme\Contracts\MemeDtoFactoryContract;
use App\Services\Meme\Dtos\MemeDto;
use Illuminate\Database\Eloquent\Collection;

class MemeDtoFactory implements MemeDtoFactoryContract
{
    /**
     * @inheritDoc
     */
    public function createFromModel(Meme $meme): MemeDto
    {
        $dto       = new MemeDto();
        $dto->id   = $meme->id;
        $dto->text = $meme->text;

        return $dto;
    }

    /**
     * @inheritDoc
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
