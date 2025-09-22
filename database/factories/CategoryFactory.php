<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // List of realistic e-commerce fashion categories
        $realCategories = [
            // Main Categories
            'Men\'s Clothing', 'Women\'s Clothing', 'Kids\' Clothing', 'Baby Clothing',

            // Clothing Types
            'T-Shirts & Tops', 'Shirts & Blouses', 'Dresses', 'Pants & Trousers',
            'Jeans & Denim', 'Shorts', 'Skirts', 'Sweaters & Hoodies',
            'Jackets & Coats', 'Suits & Blazers', 'Activewear', 'Swimwear',
            'Underwear & Lingerie', 'Sleepwear & Loungewear', 'Maternity Wear',

            // Footwear
            'Sneakers', 'Boots', 'Sandals', 'Dress Shoes', 'Casual Shoes',
            'Athletic Shoes', 'Heels', 'Flats', 'Slippers',

            // Accessories
            'Bags & Handbags', 'Wallets & Purses', 'Belts', 'Hats & Caps',
            'Scarves & Wraps', 'Jewelry', 'Watches', 'Sunglasses',
            'Gloves', 'Ties & Bow Ties',

            // Specialty
            'Formal Wear', 'Casual Wear', 'Work Wear', 'Party Wear',
            'Vintage & Retro', 'Plus Size', 'Petite', 'Tall Sizes'
        ];

        $categoryName = $this->faker->unique()->randomElement($realCategories);

        return [
            'category_name' => $categoryName,
            'category_slug' => Str::slug($categoryName),
            'category_image' => $this->faker->imageUrl(400, 300, 'fashion', true, $categoryName),
        ];
    }
}
