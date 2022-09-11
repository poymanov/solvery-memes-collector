<?php

namespace App\Services\VkParser\Repositories;

use App\Services\VkParser\Contracts\VkParserRepositoryContract;
use App\Services\VkParser\Contracts\VkPostDtoFactoryContract;
use App\Services\VkParser\Dtos\VkParserConfigDto;
use App\Services\VkParser\Exceptions\RequestFailedException;
use App\Services\VkParser\Exceptions\RequiredPropertyUndefinedException;
use Illuminate\Support\Facades\Http;

class VkParserRepository implements VkParserRepositoryContract
{
    public function __construct(
        private readonly VkParserConfigDto $vkParserConfigDto,
        private readonly VkPostDtoFactoryContract $vkPostDtoFactory
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getPostsByUrl(string $parsingDomain): array
    {
        $response = Http::get(
            $this->vkParserConfigDto->wallGetUrl,
            [
                'domain' => $parsingDomain,
                'v' => $this->vkParserConfigDto->version,
                'access_token' => $this->vkParserConfigDto->accessToken,
            ]
        );

        $data = $response->json();

        if (isset($data['error'])) {
            throw new RequestFailedException($data['error']['error_msg'] ?? null);
        }

        if (!isset($data['response'])) {
            throw new RequiredPropertyUndefinedException('response');
        }

        if (!isset($data['response']['items'])) {
            throw new RequiredPropertyUndefinedException('response.items');
        }

        return $this->vkPostDtoFactory->createFromPosts($data['response']['items']);
    }
}
