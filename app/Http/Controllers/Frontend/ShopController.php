<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;
use App\Models\ProductsImages;

class ShopController extends Controller
{
    public function viewShop()
    {
        
        $categories = Category::orderBy('category_name', 'ASC')->get();
        return view('shop.view', compact('categories'));
    }

    public function oneCategory($id, $slug)
    {
        $products = Products::findOrFail($id);
        // dd($products);
        return view('shop.categoryDetails', compact('products'));
    }

    public function oneProducts($id)
    {
        $products_details = Products::findOrFail($id);
        // dd($products_details);

        // to display images
        $multiple_images = ProductsImages::where('products_id',$id)->get();
        // dd( $multiple_images );
        return view('shop.productsDetails', compact('products_details','multiple_images'));
    }
}
