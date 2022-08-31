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
}
