<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Brands;
use App\Models\Category;
use App\Models\Products;
use App\Models\ProductsImages;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductsController extends Controller
{
    //
    public function manage()
    {

        $products = Products::latest()->get();
        return view('admin.products.manage-products', compact('products'));
    }

    public function newProducts()
    {
        // call Brand data
        $brands = Brands::latest()->get();
        $categories = Category::latest()->get();

        // get active vendor information
        $activeVendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();

        $products = Products::latest()->get();
        return view('admin.products.new-products', compact('products','brands','categories','activeVendor'));
    }

    public function storeProducts(Request $request)
    {

        $products_picture = $request->file('picture');
        // create unique id with its own products_picture extension(jpeg,png)
        $products_picture_generated = hexdec(uniqid()).'.'.$products_picture->getClientOriginalExtension();
        // resize products_picture by calling products_picture intervention package
        Image::make($products_picture)->resize(600,800)->save('upload/products/picture/'.$products_picture_generated);
        $picture = 'upload/products/picture/'.$products_picture_generated; 

        
        

        // insert data into 2 different tables
        // first table - Products
        $products = Products::create([
            'brands_id' =>$request->brands_id,
            'category_id' =>$request->category_id,
            'sub_category_id' =>$request->sub_category_id,
            'vendor_id' =>$request->vendor_id,
            'products_name' =>strtoupper($request->products_name),
            'products_slug' =>strtolower(str_replace(' ','-', $request->products_name)) ,
            'code' =>$request->code,
            'quantity' =>$request->quantity,
            'tags' =>$request->tags,
            'size' =>$request->size,
            'color' =>strtoupper($request->color),
            'description' =>ucfirst($request->description),
            'specification' =>$request->specification,
            'price' =>$request->price,
            'discount_price' =>$request->discount_price,
            'picture' => $picture,
            // 'thumbnails' => $thumbnails,
            'hot_deals' =>$request->hot_deals,
            'special_offer' =>$request->special_offer,
            'status' => 1,
            // load time
            'created_at' => Carbon::now(),
        ]);

        // second table - store thumbnails(multiple images)

        // Retrieve the product id from the query builder instance
        // $product = $products->find();
        // $products_id = $products->find($products);

        $thumbnails = $request->file('thumbnails');
        foreach ($thumbnails as $thumbnail) {
            // create unique id with its own image extension(jpeg,png)
            $thumbnail_generated = hexdec(uniqid()).'.'.$thumbnail->getClientOriginalExtension();
            // resize thumbnail by calling image intervention package
            Image::make($thumbnail)->resize(900,900)->save('upload/products/thumbnails/'.$thumbnail_generated);
            $upload_thumbnails = 'upload/products/thumbnails/'.$thumbnail_generated; 

            // insert data
            ProductsImages::insert([
                // save product_id variable above
                'products_id' => $products->id,
                'products_photo' => $upload_thumbnails,
                'created_at' => Carbon::now(),
            ]);
        }

        // dd($thumbnails);

        // session
        session()->flash('success', 'New products details has been added!');

        return redirect()->route('products.manage');

    }


    public function seeProducts($id)
    {
        // call Brand data
        $brands = Brands::latest()->get();
        $categories = Category::latest()->get();

        // get active vendor information
        $activeVendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        $multi_images = ProductsImages::where('products_id',$id)->get();


        $see_products = Products::findOrFail($id);
        return view('admin.products.editsee-products', compact('see_products','brands','categories','activeVendor','multi_images'));
    }

    public function editProducts($id)
    {
        // call Brand data
        $brands = Brands::latest()->get();
        $categories = Category::latest()->get();

        // get active vendor information
        $activeVendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();

        // get data from multiple images
        $multi_images = ProductsImages::where('products_id',$id)->get();

        $products = Products::findOrFail($id);
        return view('admin.products.editsee-products', compact('products','brands','categories','activeVendor','multi_images'));
    }

    public function updateProducts(Request $request)
    {
        $product_id = $request->id;

        Products::findOrFail($product_id)->update([
            'brands_id' =>$request->brands_id,
            'category_id' =>$request->category_id,
            'sub_category_id' =>$request->sub_category_id,
            'vendor_id' =>$request->vendor_id,
            'products_name' =>$request->products_name,
            'products_slug' =>strtolower(str_replace(' ','-', $request->products_name)) ,
            'code' =>$request->code,
            'quantity' =>$request->quantity,
            'tags' =>$request->tags,
            'size' =>$request->size,
            'color' =>$request->color,
            'description' =>$request->description,
            'specification' =>$request->specification,
            'price' =>$request->price,
            'discount_price' =>$request->discount_price,
            // 'picture' => $picture,
            // 'thumbnails' => $thumbnails,
            'hot_deals' =>$request->hot_deals,
            'special_offer' =>$request->special_offer,
            'status' => 1,
            // load time
            'created_at' => Carbon::now(),
        ]);

        // session message
        session()->flash('success', 'Products updated!');
        return redirect()->route('products.manage');        
    }

    public function updateProductsImages(Request $request)
    {
       $products_image = $request->id;
       $oldImage_id = $request->id;

       $products_picture = $request->file('picture');
       // create unique id with its own products_picture extension(jpeg,png)
       $products_picture_generated = hexdec(uniqid()).'.'.$products_picture->getClientOriginalExtension();
       // resize products_picture by calling products_picture intervention package
       Image::make($products_picture)->resize(600,800)->save('upload/products/picture/'.$products_picture_generated);
       $latest_picture = 'upload/products/picture/'.$products_picture_generated; 

        //    condition
        if (file_exists($oldImage_id)) {
            unlink($oldImage_id);
         }

         Products::findOrFail($products_image)->update([
            'picture' => $latest_picture,
            'updated_at' => Carbon::now(),
           
        ]);

           // alert
        session()->flash('success', 'Products thumbnails updated!');
        return back();
    }

    public function updateProductsMultiImages(Request $request)
    {
       $products_multi_images = $request->products_photo;
       foreach ($products_multi_images as $id => $img) {
        $imgDel = ProductsImages::findOrFail($id);
        unlink($imgDel->products_photo);

        // from storing multiple images
         // create unique id with its own image extension(jpeg,png)
         $thumbnail_generated = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
         // resize img by calling image intervention package
         Image::make($img)->resize(900,900)->save('upload/products/thumbnails/'.$thumbnail_generated);
         $upload_thumbnails = 'upload/products/thumbnails/'.$thumbnail_generated; 

         ProductsImages::where('id',$id)->update([
            'products_photos' => $upload_thumbnails,
            'updated_at' => Carbon::now(),
         ]);
       }

           // alert
        session()->flash('success', 'Products images updated!');
        return back();
    }

    public function deleteProductsMultiImages($id)
    {
        $images = ProductsImages::findOrFail($id);

        // unlink image in storage folder
        unlink($images['products_photo']);

        ProductsImages::findOrFail($id)->delete();

          // alert
          session()->flash('success', 'Products images deleted!');
          return back();
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
        $multilple = ProductsImages::where('products_id',$id)->get();
        foreach ($multilple as $multi) {
            unlink($multi->products_photo);
            ProductsImages::where('products_id',$id)->delete();
        }

        // session flash
        session()->flash('success', 'Products deleted!');

        // use sweetalert popup box - not working
        // Alert::success('Brands deleted!');
        // Alert::alert('Title', 'Message');

        return back();

    }

 


}
