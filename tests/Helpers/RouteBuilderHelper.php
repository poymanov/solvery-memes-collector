<?php

namespace Tests\Helpers;

use Tests\Helpers\RouteBuilder\AuthBuilder;
use Tests\Helpers\RouteBuilder\CommonBuilder;
use Tests\Helpers\RouteBuilder\MemeBuilder;
use Tests\Helpers\RouteBuilder\ParsingSourceBuilder;

class RouteBuilderHelper
{
    private static ?RouteBuilderHelper $instance = null;

    public CommonBuilder        $common;
    public AuthBuilder          $auth;
    public ParsingSourceBuilder $parsingSource;
    public MemeBuilder          $meme;

    private function __construct()
    {
        $this->common        = new CommonBuilder();
        $this->auth          = new AuthBuilder();
        $this->parsingSource = new ParsingSourceBuilder();
        $this->meme          = new MemeBuilder();
    }

    public static function getInstance(): RouteBuilderHelper
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}
