<?php

namespace Database\Seeders;

use App\Modules\Segment\Models\Segment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SegmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Segment::factory()->count(10)->create();
    }
}
