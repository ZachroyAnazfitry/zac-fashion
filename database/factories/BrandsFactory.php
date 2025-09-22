<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brands>
 */
class BrandsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // List of well-known fashion brands
        $realBrands = [
            'Nike', 'Adidas', 'Puma', 'Under Armour', 'Reebok',
            'Converse', 'Vans', 'New Balance', 'ASICS', 'Jordan',
            'Zara', 'H&M', 'Uniqlo', 'Forever 21', 'Gap',
            'Levi\'s', 'Calvin Klein', 'Tommy Hilfiger', 'Ralph Lauren', 'Gucci',
            'Louis Vuitton', 'Prada', 'Versace', 'Armani', 'Dolce & Gabbana',
            'Burberry', 'Chanel', 'Dior', 'Hermès', 'Balenciaga',
            'Supreme', 'Off-White', 'Stone Island', 'Kenzo', 'Balmain'
        ];
        
        $brandName = $this->faker->unique()->randomElement($realBrands);
        
        return [
            'brand_name' => $brandName,
            'brand_slug' => \Illuminate\Support\Str::slug($brandName),
            'brand_image' => $this->faker->imageUrl(300, 200, 'business', true, $brandName),
        ];
    }
}
