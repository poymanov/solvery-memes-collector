<?php

namespace Tests\Helpers\RouteBuilder\ParsingSourceBuilder;

class VkBuilder
{
    /**
     * @return string
     */
    public function index(): string
    {
        return '/parsing-sources/vk';
    }

    /**
     * @return string
     */
    public function create(): string
    {
        return '/parsing-sources/vk/create';
    }

    /**
     * @return string
     */
    public function store(): string
    {
        return '/parsing-sources/vk';
    }

    /**
     * @param int $id
     *
     * @return string
     */
    public function edit(int $id): string
    {
        return "/parsing-sources/vk/$id/edit";
    }

    /**
     * @param int $id
     *
     * @return string
     */
    public function update(int $id): string
    {
        return "/parsing-sources/vk/$id";
    }

    /**
     * @param int $id
     *
     * @return string
     */
    public function delete(int $id): string
    {
        return "/parsing-sources/vk/$id";
    }
}
