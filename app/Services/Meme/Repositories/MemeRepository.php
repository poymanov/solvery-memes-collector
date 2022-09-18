<?php

namespace App\Services\Meme\Repositories;

use App\Models\Meme;
use App\Services\Meme\Contracts\MemeDtoFactoryContract;
use App\Services\Meme\Contracts\MemeImageRepositoryContract;
use App\Services\Meme\Contracts\MemeRepositoryContract;
use App\Services\Meme\Dtos\MemeCreateDto;
use App\Services\Meme\Exceptions\MemeCreateFailedException;
use Illuminate\Support\Facades\DB;
use Throwable;

class MemeRepository implements MemeRepositoryContract
{
    public function __construct(
        private readonly MemeDtoFactoryContract $memeDtoFactory,
        private readonly MemeImageRepositoryContract $memeImageRepository
    ) {
    }


    /**
     * @inheritDoc
     */
    public function create(MemeCreateDto $memeCreateDto): void
    {
        DB::beginTransaction();

        try {
            // Создание мема
            $meme               = new Meme();
            $meme->source_type  = $memeCreateDto->sourceType;
            $meme->source_alias = $memeCreateDto->sourceAlias;
            $meme->external_id  = $memeCreateDto->externalId;
            $meme->text         = $memeCreateDto->text;

            if (!$meme->save()) {
                throw new MemeCreateFailedException();
            }

            // Создание изображений мема
            $this->memeImageRepository->create($meme->id, $memeCreateDto->images);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();

            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        $memes = Meme::orderByDesc('id')->get();

        return $this->memeDtoFactory->createFromModelsList($memes);
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
