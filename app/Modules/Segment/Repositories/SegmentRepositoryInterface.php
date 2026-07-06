<?php
declare(strict_types=1);

namespace App\Modules\Segment\Repositories;

use App\Modules\Segment\Models\Segment;
use Illuminate\Support\Collection;

interface SegmentRepositoryInterface
{
    public function findAll(): Collection;
    public function findById(string $id): ?Segment;
    public function create(array $data): Segment;
    public function update(string $id, array $data): ?Segment;
    public function delete(string $id): bool;
    public function attachCustomer(string $segmentId, string $customerId): void;
    public function detachCustomer(string $segmentId, string $customerId): void;


}
