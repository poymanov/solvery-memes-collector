<?php

namespace Tests\Helpers\ModelBuilder;

use Tests\Helpers\ModelBuilder\ParsingSourceBuilder\VkBuilder;

class ParsingSourceBuilder
{
    public VkBuilder $vk;

    public function __construct()
    {
        $this->vk = new VkBuilder();
    }
}
