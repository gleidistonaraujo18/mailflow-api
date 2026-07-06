<?php

namespace App\Modules\Customer\Services;

use App\Modules\Customer\Models\Customer;
use App\Modules\Customer\Repositories\CustomerRepositoryInterface;
use Illuminate\Support\Collection;

class CustomerService
{
    public function __construct(private CustomerRepositoryInterface $repository)
    {
    }

    public function all(): Collection
    {
        return $this->repository->findAll();
    }

    public function findById(string $id): ?Customer
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): Customer
    {
        return $this->repository->create($data);
    }

    public function update(string $id, array $data): ?Customer
    {
        return $this->repository->update($id, $data);
    }

    public function delete(string $id): bool
    {
        return $this->repository->delete($id);
    }
}
