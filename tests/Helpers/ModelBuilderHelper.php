<?php

namespace Tests\Helpers;

use Tests\Helpers\ModelBuilder\ParsingSourceBuilder;
use Tests\Helpers\ModelBuilder\UserBuilder;

class ModelBuilderHelper
{
    private static ?ModelBuilderHelper $instance = null;

    public UserBuilder          $user;
    public ParsingSourceBuilder $parsingSource;

    private function __construct()
    {
        $this->user          = new UserBuilder();
        $this->parsingSource = new ParsingSourceBuilder();
    }

    /**
     * @return ModelBuilderHelper
     */
    public static function getInstance(): ModelBuilderHelper
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}
