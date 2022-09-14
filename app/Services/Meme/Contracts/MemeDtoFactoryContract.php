<?php

namespace App\Services\Meme\Contracts;

use App\Models\Meme;
use App\Services\Meme\Dtos\MemeDto;
use Illuminate\Database\Eloquent\Collection;

interface MemeDtoFactoryContract
{
    /**
     * @param Meme $meme
     *
     * @return MemeDto
     */
    public function createFromModel(Meme $meme): MemeDto;

    /**
     * @param Collection $models
     *
     * @return MemeDto[]
     */
    public function createFromModelsList(Collection $models): array;
}
