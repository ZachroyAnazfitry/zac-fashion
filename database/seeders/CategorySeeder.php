<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // For development: clear and recreate
        if (app()->environment('local')) {
            Category::truncate();
            Category::factory()->count(25)->create(); // 25 categories for good variety
        } else {
            // For production: only create if empty
            if (Category::count() == 0) {
                Category::factory()->count(25)->create();
            }
        }
    }
}
