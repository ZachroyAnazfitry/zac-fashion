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

    public function allCategory()
    {
        $products = Products::where('status', 1)->orderBy('id','DESC')->get();
        // dd($products);
        return view('shop.categoryDetails', compact('products'));
    }

    public function oneCategory(Request $request, $id, $slug)
    {
        $products = Products::where('status', 1)->where('category_id', $id)->orderBy('id','DESC')->get();
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

    public function oneVendor(Request $request, $id)
    {
        $products = Products::where('status', 1)->where('vendor_id', $id)->orderBy('id','DESC')->get();
        // dd($products);
        return view('shop.vendorDetails', compact('products'));
    }
}
