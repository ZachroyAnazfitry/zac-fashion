<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Category;
use App\Models\Products;
use App\Models\ProductsImages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class VendorProductsController extends Controller
{
    public function allProducts()
    {
        $id = Auth::user()->id;

        $products = Products::where('vendor_id', $id)->latest()->get();

        return view('vendor.products.manage-products', compact('products'));
    }

    public function newProducts()
    {
        // call Brand data
        $brands = Brands::latest()->get();
        $categories = Category::latest()->get();

        $products = Products::latest()->get();

        return view('vendor.products.new-products', compact('products', 'brands', 'categories'));
    }

    public function storeProducts(Request $request)
    {

        $products_picture = $request->file('picture');
        // create unique id with its own products_picture extension(jpeg,png)
        $products_picture_generated = hexdec(uniqid()).'.'.$products_picture->getClientOriginalExtension();
        // resize products_picture by calling products_picture intervention package
        Image::make($products_picture)->resize(600, 800)->save('upload/products/picture/'.$products_picture_generated);
        $picture = 'upload/products/picture/'.$products_picture_generated;

        // insert data into 2 different tables
        // first table - Products
        $products = Products::insertGetID([
            'brands_id' => $request->brands_id,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'vendor_id' => Auth::user()->id,  // get current vendor id
            'products_name' => strtoupper($request->products_name),
            'products_slug' => strtolower(str_replace(' ', '-', $request->products_name)),
            'code' => $request->code,
            'quantity' => $request->quantity,
            'tags' => $request->tags,
            'size' => $request->size,
            'color' => strtoupper($request->color),
            'description' => ucfirst($request->description),
            'specification' => $request->specification,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'picture' => $picture,
            // 'thumbnails' => $thumbnails,
            'hot_deals' => $request->hot_deals,
            'special_offer' => $request->special_offer,
            'status' => 1,
            // load time
            'created_at' => Carbon::now(),
        ]);

        // second table - store thumbnails(multiple images)

        // Retrieve the product id from the query builder instance
        $product = $products->first();
        $product_id = $product->id;

        $thumbnails = $request->file('thumbnails');
        foreach ($thumbnails as $thumbnail) {
            // create unique id with its own image extension(jpeg,png)
            $thumbnail_generated = hexdec(uniqid()).'.'.$thumbnail->getClientOriginalExtension();
            // resize thumbnail by calling image intervention package
            Image::make($thumbnail)->resize(900, 900)->save('upload/products/thumbnails/'.$thumbnail_generated);
            $upload_thumbnails = 'upload/products/thumbnails/'.$thumbnail_generated;

            // insert data
            ProductsImages::insert([
                // save product_id variable above
                'products_id' => $product_id,
                'products_photo' => $upload_thumbnails,
                'created_at' => Carbon::now(),
            ]);
        }

        // session
        session()->flash('success', 'New products details has been added!');

        return redirect()->route('vendor.all.products');

    }

    public function seeProducts($id)
    {
        // call Brand data
        $brands = Brands::latest()->get();
        $categories = Category::latest()->get();
        $see_products = Products::findOrFail($id);

        return view('vendor.products.editsee-products', compact('see_products', 'brands', 'categories'));
    }

    public function editProducts($id)
    {
        // call Brand data
        $brands = Brands::latest()->get();
        $categories = Category::latest()->get();
        $products = Products::findOrFail($id);

        return view('vendor.products.editsee-products', compact('products', 'brands', 'categories'));
    }

    public function updateProducts(Request $request)
    {
        $product_id = $request->id;

        Products::findOrFail($product_id)->update([
            'brands_id' => $request->brands_id,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            // 'vendor_id' =>$request->vendor_id,
            'products_name' => $request->products_name,
            'products_slug' => strtolower(str_replace(' ', '-', $request->products_name)),
            'code' => $request->code,
            'quantity' => $request->quantity,
            'tags' => $request->tags,
            'size' => $request->size,
            'color' => $request->color,
            'description' => $request->description,
            'specification' => $request->specification,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            // 'picture' => $picture,
            // 'thumbnails' => $thumbnails,
            'hot_deals' => $request->hot_deals,
            'special_offer' => $request->special_offer,
            'status' => 1,
            // load time
            'created_at' => Carbon::now(),
        ]);

        // session message
        session()->flash('success', 'Products updated!');

        return redirect()->route('vendor.all.products');
    }

    public function inactiveProducts($id)
    {
        Products::findOrFail($id)->update([
            'status' => 0,
        ]);

        // alert
        session()->flash('success', 'Products deactivated!');

        return back();
    }

    public function activeProducts($id)
    {
        Products::findOrFail($id)->update([
            'status' => 1,
        ]);

        // alert
        session()->flash('success', 'Products activated!');

        return back();
    }

    public function deleteProducts($id)
    {
        //    delete brand function
        $products = Products::findOrFail($id);
        // also delete picture and thumbnails in created files
        unlink($products->picture);
        $products->delete();

        // delete multilple pictures
        $multilple = ProductsImages::where('products_id', $id)->get();
        foreach ($multilple as $multi) {
            unlink($multi->products_photo);
            ProductsImages::where('products_id', $id)->delete();
        }

        // session flash
        session()->flash('success', 'Products deleted!');

        // use sweetalert popup box - not working
        // Alert::success('Brands deleted!');
        // Alert::alert('Title', 'Message');

        return back();

    }
}
