<?php

namespace App\Services\Meme\Factories;

use App\Models\Meme;
use App\Services\Meme\Contracts\MemeDtoFactoryContract;
use App\Services\Meme\Dtos\MemeDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

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

        $images = [];

        foreach ($meme->images as $image) {
            $images[] = Storage::url($image->path);
        }

        $dto->images = $images;

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
