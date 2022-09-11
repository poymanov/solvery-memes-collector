<?php

namespace App\Providers;

use App\Services\VkParser\Contracts\VkParserRepositoryContract;
use App\Services\VkParser\Contracts\VkParserServiceContract;
use App\Services\VkParser\Contracts\VkPostDtoFactoryContract;
use App\Services\VkParser\Dtos\VkParserConfigDto;
use App\Services\VkParser\Factories\VkPostDtoFactory;
use App\Services\VkParser\Repositories\VkParserRepository;
use App\Services\VkParser\VkParserService;
use Illuminate\Support\ServiceProvider;

class VkParserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $vkParserConfigDto = new VkParserConfigDto();
        $vkParserConfigDto->wallGetUrl = config('parser.vk.wallGetUrl');
        $vkParserConfigDto->version = config('parser.vk.version');
        $vkParserConfigDto->accessToken = config('parser.vk.accessToken');

        $this->app->singleton(
            VkParserRepositoryContract::class,
            fn ($app) => new VkParserRepository($vkParserConfigDto, $app->make(VkPostDtoFactoryContract::class))
        );

        $this->app->singleton(VkParserServiceContract::class, VkParserService::class);
        $this->app->singleton(VkPostDtoFactoryContract::class, VkPostDtoFactory::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
