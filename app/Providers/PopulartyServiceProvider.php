<?php

namespace App\Providers;

use App\Exceptions\IncorrectProviderException;
use App\Interface\PopularityServiceInterface;
use App\Services\GitHubPopularityService;
use App\Support\Enums\ProviderType;
use Illuminate\Support\ServiceProvider;

class PopulartyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PopularityServiceInterface::class, function () {
            switch (config('services.provider')) {
                case ProviderType::GITHUB:
                    return new GitHubPopularityService();
                    break;
                default:
                    throw new IncorrectProviderException();
            }
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
