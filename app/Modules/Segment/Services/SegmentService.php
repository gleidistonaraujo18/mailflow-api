<?php

declare(strict_types=1);

namespace App\Modules\Segment\Services;

use App\Modules\Segment\Models\Segment;
use App\Modules\Segment\Repositories\SegmentRepositoryInterface;
use Illuminate\Support\Collection;

class SegmentService
{
    public function __construct(private SegmentRepositoryInterface $repository)
    {

    }

    public function getAll(): Collection
    {
        return $this->repository->findAll();
    }

    public function findById(string $id): ?Segment
    {
        return $this->repository->findById($id);

    }

    public function create(array $data): Segment
    {
        return $this->repository->create($data);
    }

    public function update(string $id, array $data): ?Segment
    {
        return $this->repository->update($id, $data);
    }

    public function delete(string $id): bool
    {
        return $this->repository->delete($id);
    }

    public function attachCustomer(string $segmentId, string $customerId): void
    {
        $this->repository->attachCustomer($segmentId, $customerId);
    }

    public function detachCustomer(string $segmentId, string $customerId): void
    {
        $this->repository->detachCustomer($segmentId, $customerId);
    }


}
