<?php


namespace App\Modules\Customer\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Customer\Http\Requests\StoreCustomerRequest;
use App\Modules\Customer\Http\Requests\UpdateCustomerRequest;
use App\Modules\Customer\Models\Customer;
use App\Modules\Customer\Services\CustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class CustomerController extends Controller
{
    public function __construct(private CustomerService $service)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json($this->service->all());
    }

    public function show(string $id): JsonResponse
    {
        $customer = $this->service->findById($id);

        if (!$customer) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        return response()->json($customer);
    }

    public function store(StoreCustomerRequest $data): JsonResponse
    {
        $this->service->create($data->validated());
        return response()->json(['message' => 'Cliente criado com sucesso'], 201);
    }

    public function update(string $id, UpdateCustomerRequest $data): JsonResponse
    {
        $customer = $this->service->findById($id);
        if (!$customer) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        $this->service->update($id, $data->validated());

        return response()->json(['message' => 'Cliente atualizado com sucesso']);
    }

    public function destroy(string $id): JsonResponse
    {
        $customer = $this->service->findById($id);

        if (!$customer) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        $this->service->delete($id);

        return response()->json(null, 204);
    }

}
