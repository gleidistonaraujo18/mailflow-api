<?php

declare(strict_types=1);

namespace App\Modules\Customer\Repositories;

use App\Modules\Customer\Models\Customer;
use Illuminate\Support\Collection;

interface CustomerRepositoryInterface
{
    public function findAll(): Collection;
    public function findById(string $id): ?Customer;
    public function create(array $data): Customer;
    public function update(string $id, array $data):?Customer;
    public function delete(string $id): bool;



}
