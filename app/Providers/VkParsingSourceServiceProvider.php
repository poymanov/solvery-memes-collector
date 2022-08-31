<?php

namespace App\Providers;

use App\Services\VkParsingSource\Contracts\VkParsingSourceRepositoryContract;
use App\Services\VkParsingSource\Contracts\VkParsingSourceServiceContract;
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
        $this->app->singleton(VkParsingSourceRepositoryContract::class, VkParsingSourceRepository::class);
        $this->app->singleton(VkParsingSourceServiceContract::class, VkParsingSourceService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
