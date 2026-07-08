<?php

namespace App\Modules\Campaign\Services;

use App\Jobs\ProcessCampaignBatch;
use App\Modules\Campaign\Enums\CampaignStatus;
use App\Modules\Campaign\Models\Campaign;
use App\Modules\Campaign\Repositories\CampaignRepositoryInterface;

class CampaignService
{
    public function __construct(private CampaignRepositoryInterface $repository)
    {
    }

    public function findById(string $id): ?Campaign
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): Campaign
    {
        return $this->repository->create($data);
    }

    public function updateStatus(string $id, CampaignStatus $status): void
    {
        $this->repository->updateStatus($id, $status);
    }

    public function dispatch(string $campaignId): void
    {
        $campaign = $this->findById($campaignId);

        $customers = $campaign->segment->customers;

        // chunk sem callback na Collection
        $lotes = $customers->chunk(1000);

        foreach ($lotes as $lote) {
            $emails = $lote->pluck('email')->toArray();

            ProcessCampaignBatch::dispatch(
                $emails,
                $campaign->subject,
                $campaign->body,
                $campaign->id
            );
        }

        $this->repository->updateStatus($campaignId, CampaignStatus::Processing);
    }

}
