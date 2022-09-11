<?php

namespace App\Services\VkParser\Contracts;

use App\Services\VkParser\Dtos\VkPostDto;
use App\Services\VkParser\Exceptions\RequiredPropertyUndefinedException;

interface VkPostDtoFactoryContract
{
    /**
     * @param array $post
     *
     * @return VkPostDto
     * @throws RequiredPropertyUndefinedException
     */
    public function createFromPost(array $post): VkPostDto;

    /**
     * @param array $posts
     *
     * @return VkPostDto[]
     * @throws RequiredPropertyUndefinedException
     */
    public function createFromPosts(array $posts): array;
}
