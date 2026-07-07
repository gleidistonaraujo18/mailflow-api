<?php

namespace Database\Factories;

use App\Modules\Customer\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;


class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}
