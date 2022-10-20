<?php

namespace App\Providers;

use Main\Domain\CoolWord\TagRepository;
use Main\Infra\CoolWord\EloquentTag;
use Illuminate\Support\ServiceProvider;

class TagServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TagRepository::class, EloquentTag::class);
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
