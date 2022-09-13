<?php

namespace App\Services\Meme\Repositories;

use App\Models\Meme;
use App\Services\Meme\Contracts\MemeRepositoryContract;
use App\Services\Meme\Dtos\MemeCreateDto;
use App\Services\Meme\Exceptions\MemeCreateFailedException;

class MemeRepository implements MemeRepositoryContract
{
    /**
     * @inheritDoc
     */
    public function create(MemeCreateDto $memeCreateDto): void
    {
        $meme               = new Meme();
        $meme->source_type  = $memeCreateDto->sourceType;
        $meme->source_alias = $memeCreateDto->sourceAlias;
        $meme->external_id  = $memeCreateDto->externalId;
        $meme->text         = $memeCreateDto->text;

        if (!$meme->save()) {
            throw new MemeCreateFailedException();
        }
    }

    /**
     * @inheritDoc
     */
    public function getExistedExternalIds(string $sourceType, string $sourceAlias, array $externalIds): array
    {
        $data = Meme::whereSourceAlias($sourceAlias)->whereIn('external_id', $externalIds)->get(['external_id'])->toArray();

        return array_map(fn ($item) => $item['external_id'], $data);
    }
}
