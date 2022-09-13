<?php

namespace App\Providers;

use App\Jobs\ParseVkSource;
use App\Services\VkParser\Contracts\VkParserServiceContract;
use App\Services\VkParsingSource\Contracts\VkParsingSourceDtoFactoryContract;
use App\Services\VkParsingSource\Contracts\VkParsingSourceRepositoryContract;
use App\Services\VkParsingSource\Contracts\VkParsingSourceServiceContract;
use App\Services\VkParsingSource\Factories\VkParsingSourceDtoFactory;
use App\Services\VkParsingSource\Repositories\VkParsingSourceRepository;
use App\Services\VkParsingSource\VkParsingSourceService;
use Illuminate\Support\ServiceProvider;

class VkParsingSourceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(VkParsingSourceDtoFactoryContract::class, VkParsingSourceDtoFactory::class);
        $this->app->singleton(VkParsingSourceRepositoryContract::class, VkParsingSourceRepository::class);
        $this->app->singleton(VkParsingSourceServiceContract::class, VkParsingSourceService::class);


        $this->app->bindMethod([ParseVkSource::class, 'handle'], function ($job, $app) {
            return $job->handle($app->make(VkParserServiceContract::class));
        });
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
