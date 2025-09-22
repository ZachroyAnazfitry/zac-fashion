<?php

namespace Database\Seeders;

use App\Models\Brands;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /// For development: clear and recreate
        if (app()->environment('local')) {
            Brands::truncate();
            Brands::factory()->count(20)->create(); // Increased to 20 for more variety
        } else {
            // For production: only create if empty
            if (Brands::count() == 0) {
                Brands::factory()->count(20)->create();
            }
        }
    }
}
