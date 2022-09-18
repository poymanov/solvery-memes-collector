<?php

namespace App\Services\Meme\Repositories;

use App\Models\MemeImage;
use App\Services\Meme\Contracts\MemeImageRepositoryContract;
use App\Services\Meme\Exceptions\MemeImageCreateFailedException;
use App\Services\Meme\Exceptions\MemeImageStoreFileDetectExtensionFailedException;
use App\Services\Meme\Exceptions\MemeImageStoreFileFailedException;
use Exception;
use Illuminate\Support\Facades\Storage;
use Throwable;

class MemeImageRepository implements MemeImageRepositoryContract
{
    /**
     * @inheritDoc
     */
    public function create(int $memeId, array $images): void
    {
        // Сохранение данных по изображению мема
        foreach ($images as $image) {
            // Определение имени файла для сохранения
            $filePath = $this->getImageFilePath($memeId, $image);

            $memeImage          = new MemeImage();
            $memeImage->meme_id = $memeId;
            $memeImage->path    = $filePath;

            if (!$memeImage->save()) {
                throw new MemeImageCreateFailedException($memeId);
            }

            try {
                // Сохранение изображения мема
                $imageContent = file_get_contents($image);

                if ($imageContent === false) {
                    throw new Exception('Failed to get image content');
                }

                Storage::disk('public')->put($filePath, $imageContent);
            } catch (Throwable $e) {
                throw new MemeImageStoreFileFailedException($memeId, $e->getMessage());
            }
        }
    }

    /**
     * Формирование пути для сохранения файла
     *
     * @param int    $memeId
     * @param string $image
     *
     * @return string
     * @throws MemeImageStoreFileFailedException
     */
    private function getImageFilePath(int $memeId, string $image): string
    {
        try {
            // Формирование пути
            $pathInfo = pathinfo($image);

            $filename = $pathInfo['filename'];

            if (!isset($pathInfo['extension'])) {
                throw new MemeImageStoreFileDetectExtensionFailedException($image);
            }

            $extension = match (true) {
                str_contains($pathInfo['extension'], 'png') => 'png',
                str_contains($pathInfo['extension'], 'jpg') => 'jpg',
                str_contains($pathInfo['extension'], 'webp') => 'webp',
                default => null
            };

            if (is_null($extension)) {
                throw new MemeImageStoreFileDetectExtensionFailedException($image);
            }

            return 'memes/' . $memeId . '/' . $filename . '.' . $extension;
        } catch (Throwable $e) {
            throw new MemeImageStoreFileFailedException($memeId, $e->getMessage());
        }
    }
}
