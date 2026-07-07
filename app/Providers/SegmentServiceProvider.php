<?php

namespace App\Providers;

use App\Modules\Segment\Repositories\SegmentRepository;
use App\Modules\Segment\Repositories\SegmentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class SegmentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SegmentRepositoryInterface::class, SegmentRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
