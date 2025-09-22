<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
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
            Slider::truncate();
            Slider::factory()->count(6)->create(); // 6 sliders for homepage rotation
        } else {
            // For production: only create if empty
            if (Slider::count() == 0) {
                Slider::factory()->count(6)->create();
            }
        }
    }
}
