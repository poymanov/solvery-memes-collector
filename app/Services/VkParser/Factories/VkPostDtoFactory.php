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

        $images = [];

        $vkPostDto       = new VkPostDto();
        $vkPostDto->id   = $post['id'];
        $vkPostDto->text = $post['text'] ?? null;

        if (isset($post['attachments'])) {
            foreach ($post['attachments'] as $attachment) {
                // Если тип вложения не изображение
                if ($attachment['type'] !== 'photo') {
                    continue;
                }

                // Если нет данных по изображению
                if (!isset($attachment['photo']) || !isset($attachment['photo']['sizes'])) {
                    continue;
                }

                $maxWidth = 0;
                $maxHeight = 0;

                $photo = null;

                // Получение изображения максимального размера
                foreach ($attachment['photo']['sizes'] as $size) {
                    if ($size['height'] > $maxHeight && $size['width'] > $maxWidth) {
                        $maxWidth = $size['width'];
                        $maxHeight = $size['height'];

                        $photo = $size;
                    }
                }

                if (is_null($photo) || !isset($photo['url'])) {
                    continue;
                }

                $images[] = $photo['url'];
            }
        }

        $vkPostDto->images = $images;

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
