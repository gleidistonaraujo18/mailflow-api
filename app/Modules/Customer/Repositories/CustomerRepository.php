<?php

declare(strict_types=1);

namespace App\Modules\Customer\Repositories;

use App\Modules\Customer\Models\Customer;
use Illuminate\Support\Collection;

class CustomerRepository implements CustomerRepositoryInterface
{

    public function findAll(): Collection
    {
        return Customer::all();
    }

    public function findById(string $id): ?Customer
    {
        return Customer::find($id);
    }

    public function create(array $data): Customer
    {
        return Customer::create($data);
    }

    public function update(string $id, array $data): ?Customer
    {
        $customer = Customer::find($id);

        if(!$customer){
            return null;
        }

        $customer->update($data);
        return $customer;
    }

    public function delete(string $id): bool{
        return Customer::find($id)->delete();
    }
}
