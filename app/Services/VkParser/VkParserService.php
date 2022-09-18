<?php

namespace App\Services\VkParser;

use App\Enums\MemeSourceTypeEnum;
use App\Enums\ParsingStatusEnum;
use App\Services\Meme\Contracts\MemeServiceContract;
use App\Services\Meme\Exceptions\MemeCreateFailedException;
use App\Services\VkParser\Contracts\VkParserRepositoryContract;
use App\Services\VkParser\Contracts\VkParserServiceContract;
use App\Services\VkParsingSource\Contracts\VkParsingSourceServiceContract;
use App\Services\VkParsingSource\Dtos\VkParsingSourceDto;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceNotFoundException;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceUpdateParsingStatusException;
use Illuminate\Support\Facades\Log;
use Throwable;

class VkParserService implements VkParserServiceContract
{
    public function __construct(
        private readonly VkParserRepositoryContract $vkParserRepository,
        private readonly VkParsingSourceServiceContract $vkParsingSourceService,
        private readonly MemeServiceContract $memeService
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getPostsByUrl(string $parsingDomain): array
    {
        return $this->vkParserRepository->getPostsByUrl($parsingDomain);
    }

    /**
     * Парсинг источника
     *
     * @param VkParsingSourceDto $vkParsingSource
     *
     * @return void
     * @throws Exceptions\RequiredPropertyUndefinedException
     * @throws Throwable
     * @throws MemeCreateFailedException
     * @throws VkParsingSourceNotFoundException
     * @throws VkParsingSourceUpdateParsingStatusException
     */
    public function parseSource(VkParsingSourceDto $vkParsingSource)
    {
        try {
            $parsingDomain = str_replace('https://vk.com/', '', $vkParsingSource->url);

            // Получение URL из источника
            $posts = $this->getPostsByUrl($parsingDomain);

            $externalIds = [];

            // Получение списка ID постов для проверки перед добавлением в мемы
            foreach ($posts as $post) {
                if (is_null($post->text) && empty($post->images)) {
                    continue;
                }

                $externalIds[] = $post->id;
            }

            // Получение списка ID постов, которые ещё не существуют в мемах
            $notExistedIds = $this->memeService->getNotExistedExternalIds(MemeSourceTypeEnum::VK, $parsingDomain, $externalIds);

            foreach ($posts as $post) {
                if (!in_array($post->id, $notExistedIds)) {
                    continue;
                }

                // Добавление данных поста в мемы
                $this->memeService->create(MemeSourceTypeEnum::VK, $parsingDomain, (string)$post->id, $post->text, $post->images);
            }

            $this->vkParsingSourceService->updateParsingStatus($vkParsingSource->id, ParsingStatusEnum::SUCCESS, null);
        } catch (Throwable $e) {
            $this->vkParsingSourceService->updateParsingStatus($vkParsingSource->id, ParsingStatusEnum::FAILED, $e->getMessage());

            Log::error('VK Parser (' . $vkParsingSource->url . '): ' . $e->getMessage());
            throw $e;
        }
    }
}
