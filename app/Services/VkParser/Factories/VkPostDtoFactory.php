<?php

namespace App\Services\VkParser\Factories;

use App\Services\VkParser\Contracts\VkPostDtoFactoryContract;
use App\Services\VkParser\Dtos\VkPostDto;
use App\Services\VkParser\Exceptions\RequiredPropertyUndefinedException;

class VkPostDtoFactory implements VkPostDtoFactoryContract
{
    /**
     * @inheritDoc
     */
    public function createFromPost(array $post): VkPostDto
    {
        if (!isset($post['id'])) {
            throw new RequiredPropertyUndefinedException('id');
        }

        $vkPostDto       = new VkPostDto();
        $vkPostDto->id   = $post['id'];
        $vkPostDto->text = $post['text'] ?? null;

        return $vkPostDto;
    }

    /**
     * @inheritDoc
     */
    public function createFromPosts(array $posts): array
    {
        $dtos = [];

        foreach ($posts as $post) {
            $dtos[] = $this->createFromPost($post);
        }

        return $dtos;
    }
}
