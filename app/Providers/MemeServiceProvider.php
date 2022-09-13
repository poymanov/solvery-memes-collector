<?php

namespace App\Providers;

use App\Services\Meme\Contracts\MemeRepositoryContract;
use App\Services\Meme\Contracts\MemeServiceContract;
use App\Services\Meme\MemeService;
use App\Services\Meme\Repositories\MemeRepository;
use Illuminate\Support\ServiceProvider;

class MemeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MemeRepositoryContract::class, MemeRepository::class);
        $this->app->singleton(MemeServiceContract::class, MemeService::class);
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
