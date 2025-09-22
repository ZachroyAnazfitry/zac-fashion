<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Realistic e-commerce promotional slider content
        $sliderContent = [
            [
                'title' => 'Summer Sale 2024',
                'subtitle' => 'Up to 70% Off',
                'description' => 'Get the best deals on summer fashion. Limited time offer on all summer collections.',
            ],
            [
                'title' => 'New Arrivals',
                'subtitle' => 'Fresh Fashion Trends',
                'description' => 'Discover the latest fashion trends and styles. Shop our newest collection now.',
            ],
            [
                'title' => 'Free Shipping',
                'subtitle' => 'On Orders Over $50',
                'description' => 'Enjoy free shipping on all orders above $50. Shop now and save on delivery.',
            ],
            [
                'title' => 'Designer Collection',
                'subtitle' => 'Premium Quality',
                'description' => 'Explore our exclusive designer collection featuring luxury brands and premium quality.',
            ],
            [
                'title' => 'Winter Sale',
                'subtitle' => 'Cozy & Warm',
                'description' => 'Stay warm this winter with our cozy collection. Special discounts on winter wear.',
            ],
            [
                'title' => 'Black Friday Deals',
                'subtitle' => 'Biggest Sale of the Year',
                'description' => 'Don\'t miss out on our biggest sale! Up to 80% off on selected items.',
            ],
            [
                'title' => 'Athletic Wear',
                'subtitle' => 'Stay Active, Look Great',
                'description' => 'Premium athletic wear for your active lifestyle. Comfort meets performance.',
            ],
            [
                'title' => 'Back to School',
                'subtitle' => 'Student Discounts',
                'description' => 'Special discounts for students. Get ready for the new semester in style.',
            ],
            [
                'title' => 'Wedding Collection',
                'subtitle' => 'Perfect for Special Days',
                'description' => 'Find the perfect outfit for your special occasions. Elegant and sophisticated.',
            ],
            [
                'title' => 'Kids Fashion',
                'subtitle' => 'Cute & Comfortable',
                'description' => 'Adorable and comfortable clothing for your little ones. Safe and stylish.',
            ],
        ];
        
        $selectedContent = $this->faker->randomElement($sliderContent);
        
        return [
            'title' => $selectedContent['title'],
            'subtitle' => $selectedContent['subtitle'],
            'description' => $selectedContent['description'],
            'slider_image' => $this->faker->imageUrl(1200, 600, 'fashion', true, $selectedContent['title']),
        ];
    }
}
