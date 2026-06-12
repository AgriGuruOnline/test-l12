<?php

namespace Database\Seeders;

use App\Models\CensusRecord;
use Illuminate\Database\Seeder;

class CensusRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate 50 census records using the factory
        CensusRecord::factory()->count(50)->create();
    }
}
