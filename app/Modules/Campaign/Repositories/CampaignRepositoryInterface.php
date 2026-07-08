<?php
declare(strict_types=1);

namespace App\Modules\Campaign\Repositories;

use App\Modules\Campaign\Enums\CampaignStatus;
use App\Modules\Campaign\Models\Campaign;

interface CampaignRepositoryInterface
{

    public function findById(string $id): ?Campaign;
    public function create(array $data): Campaign;
    public function updateStatus(string $id, CampaignStatus $status): void;

}
