<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\Contracts\CensusRecordRepositoryInterface::class,
            \App\Repositories\Eloquent\EloquentCensusRecordRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (
            str_starts_with(request()->header('X-Forwarded-Proto', ''), 'https') || 
            request()->secure() || 
            str_contains(request()->header('Host', ''), 'devtunnels.ms')
        ) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
