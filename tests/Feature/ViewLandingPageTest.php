<?php

namespace Tests\Feature;

use App\Models\Products;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewLandingPageTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function test_landing_page()
    {
        // arrange

        // act
        $response = $this->get('/');

        // assert
        $response->assertStatus(200);

        // display this words
        $response->assertSee('Ok or not');

    }

    public function test_new_product()
    {
        $products = Products::create([
            'brands_id' => 1,
            'category_id' => 1,
            'sub_category_id' => 1,
            'vendor_id' => 1,
            'products_name' => 'nike1',
            'products_slug' => 'nike-1' ,
            'code' => 'X123',
            'quantity' =>2,
            'size' =>'S',
            'color' =>'purple',
            'description' => 'best product ever',
            'price' => 300,
            'discount_price' => 'RM100',
            'picture' => 'upload/products/picture/gambar.jpg',
            'status' => 'active',
           
        ]);

         // act
         $response = $this->get('/');

         // display this words
        $response->assertSee($products->products_name);
    }
}
