<?php
declare(strict_types=1);

namespace App\Modules\Campaign\Repositories;

use App\Modules\Campaign\Enums\CampaignStatus;
use App\Modules\Campaign\Models\Campaign;

class CampaignRepository implements CampaignRepositoryInterface
{
    public function findById(string $id): ?Campaign
    {
        return Campaign::find($id);
    }

    public function create(array $data): Campaign{
        return Campaign::create($data);
    }

    public function updateStatus(string $id, CampaignStatus $status): void
    {
        $campaign = Campaign::find($id);

        if (!$campaign) {
            return;
        }

        $campaign->status = $status;
        $campaign->save();
    }

}
