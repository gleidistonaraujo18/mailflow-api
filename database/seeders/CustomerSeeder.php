<?php

namespace Database\Seeders;

use App\Modules\Customer\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::factory()->count(10)->create();
    }
}
