<?php

namespace App\Modules\Segment\Repositories;

use App\Modules\Segment\Models\Segment;
use Illuminate\Support\Collection;

class SegmentRepository implements SegmentRepositoryInterface
{

    public function findAll(): Collection
    {
        return Segment::all();
    }

    public function findById(string $id): ?Segment
    {
        return Segment::find($id);
    }

    public function create(array $data): Segment
    {
        return Segment::create($data);
    }

    public function update(string $id, array $data): ?Segment
    {
        $segment = Segment::find($id);
        if(!$segment){
            return null;
        }

        $segment->update($data);
        return $segment;
    }

    public function delete(string $id): bool
    {
        $segment = Segment::find($id);

        if (!$segment) {
            return false;
        }

        return $segment->delete();
    }

    public function attachCustomer(string $segmentId, string $customerId): void
    {
        $segment = Segment::find($segmentId);
        $segment->customers()->attach($customerId);
    }

    public function detachCustomer(string $segmentId, string $customerId): void
    {
        $segment = Segment::find($segmentId);
        $segment->customers()->detach($customerId);
    }
}
