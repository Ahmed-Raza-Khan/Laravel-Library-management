<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\BookIssueServiceInterface;
use App\Contracts\FineServiceInterface;
use App\Services\BookIssueService;
use App\Services\FineService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BookIssueServiceInterface::class, BookIssueService::class);
        $this->app->bind(FineServiceInterface::class, FineService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
