<?php

namespace App\Modules\Segment\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Segment\Http\Requests\StoreSegmentRequest;
use App\Modules\Segment\Http\Requests\UpdateSegmentRequest;
use App\Modules\Segment\Services\SegmentService;
use Illuminate\Http\JsonResponse;

class SegmentController extends Controller
{

    public function __construct(private SegmentService $service)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json($this->service->getAll());
    }

    public function findById(string $id): JsonResponse
    {
        $segment = $this->service->findById($id);

        if (!$segment) {
            return response()->json(['message' => 'Segmento não existe!'], 404);
        }
        return response()->json([$segment], 200);
    }

    public function store(StoreSegmentRequest $request): JsonResponse
    {
        return response()->json([$this->service->create($request->validated())],201);
    }

    public function update(UpdateSegmentRequest $request, string $id): JsonResponse
    {
        $segment = $this->service->findById($id);

        if (!$segment) {
            return response()->json(['message' => 'Segmento não existe!'], 404);
        }

        $this->service->update($id, $request->validated());

        return response()->json(['message' => 'Segmento atualizado com sucesso!']);
    }

    public function destroy(string $id): JsonResponse
    {
        $segment = $this->service->findById($id);
        if (!$segment) {
            return response()->json(['message' => 'Segmento não existe!'], 404);
        }

        $this->service->delete($id);
        return response()->json(['message' => 'Segmento removido com sucesso!']);
    }

    public function attachCustomer(string $segmentId, string $customerId): JsonResponse
    {
        $this->service->attachCustomer($segmentId, $customerId);
        return response()->json(['message' => 'Cliente adicionado ao segmento!']);
    }

    public function detachCustomer(string $segmentId, string $customerId): JsonResponse
    {
        $this->service->detachCustomer($segmentId, $customerId);
        return response()->json(['message' => 'Cliente removido do segmento!']);
    }
}
