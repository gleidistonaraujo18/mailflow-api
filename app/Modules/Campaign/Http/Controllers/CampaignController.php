<?php

namespace App\Modules\Campaign\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaign\Http\Requests\StoreCampaignRequest;
use App\Modules\Campaign\Services\CampaignService;
use Illuminate\Http\JsonResponse;

class CampaignController extends Controller
{
    public function __construct(private CampaignService $service)
    {
    }

    public function store(StoreCampaignRequest $request): JsonResponse
    {
        $this->service->create($request->validated());
        return response()->json(['message' => "Campanha cadastrada com sucesso!"]);
    }

    public function dispatch(string $campaignId): JsonResponse{
        $this->service->dispatch($campaignId);
        return response()->json(['message' => "Campanha disparada com sucesso!"],200);
    }
}
