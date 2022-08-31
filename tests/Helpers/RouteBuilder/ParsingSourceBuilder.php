<?php

namespace Tests\Helpers\RouteBuilder;

use Tests\Helpers\RouteBuilder\ParsingSourceBuilder\VkBuilder;

class ParsingSourceBuilder
{
    public VkBuilder $vk;

    public function __construct()
    {
        $this->vk = new VkBuilder();
    }
}
