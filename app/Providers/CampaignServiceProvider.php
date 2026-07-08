<?php

namespace App\Providers;

use App\Modules\Campaign\Repositories\CampaignRepository;
use App\Modules\Campaign\Repositories\CampaignRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class CampaignServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CampaignRepositoryInterface::class, CampaignRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
