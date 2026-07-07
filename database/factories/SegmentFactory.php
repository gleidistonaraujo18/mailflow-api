<?php

namespace Database\Factories;

use App\Modules\Segment\Models\Segment;
use Illuminate\Database\Eloquent\Factories\Factory;


class SegmentFactory extends Factory
{
    protected $model = Segment::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
        ];
    }
}
