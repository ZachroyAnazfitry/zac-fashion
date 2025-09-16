<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandsController extends Controller
{
    //
    public function brands()
    {
        // call all data
        // $brands = Brand::all();
        $brands = Brands::latest()->get();

        // dd($brands);

        return view('admin.brand', compact('brands'));
    }

    public function storeNewBrands(Request $request)
    {

        $image = $request->file('brand_image');
        // create unique id with its own image extension(jpeg,png)
        $image_generated = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        // resize image by calling image intervention package
        Image::make($image)->resize(300, 300)->save('upload/brand/'.$image_generated);
        $brand_image_url = 'upload/brand/'.$image_generated;

        Brands::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            'brand_image' => $brand_image_url,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        /**
         * only able to download certain image extension - png file
         * Example of error - Unsupported image type directory. GD driver is only able to decode JPG, PNG, GIF, BMP or WebP files.
         */

        /**
         * below code is not working
         * probably due to undefined url image stored in DB
         */

        // $brands = new Brand();
        // $brands->brand_name = $request->brand_name;
        // brand_slug to lowercase and replace empty space with hyphen(-)
        // $brands->brand_slug = strtolower(str_replace(' ', '-', $request->brand_name));
        // $brands->brand_image = $brand_image;
        // $brands->brand_image = $request->brand_image;
        // $brands->save();

        // session flash
        session()->flash('success', 'Brands added!');

        return back();
        // return redirect()->route('admin.brand.index');
    }

    public function editNewBrands($id)
    {
        $brands = Brands::findOrFail($id);

        return view('admin.edit-brand', compact('brands'));
    }

    public function updateNewBrands(Request $request)
    {
        // for testing purposes
        // $brand_id = $request->id;

        // Brand::findOrFail($brand_id)->update([
        //     'brand_name' => $request->brand_name,
        //     'brand_image' => $request->brand_image,
        // ]);

        // session()->flash('success', 'Brands updated!');
        // return redirect('/brands');

        $brand_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('brand_image')) {
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/brand/'.$name_gen);
            $save_url = 'upload/brand/'.$name_gen;

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            Brands::findOrFail($brand_id)->update([
                'brand_name' => strtoupper($request->brand_name),
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'brand_image' => $save_url,
            ]);

            session()->flash('success', 'Brands updated!');

            return redirect('/brands');

        } else {
            Brands::findOrFail($brand_id)->update([
                'brand_name' => strtoupper($request->brand_name),
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            ]);

            session()->flash('success', 'Brands updated!');

            return redirect('/brands');
        }

    }

    public function deleteNewBrands($id)
    {
        //    delete brand function
        $brands = Brands::findOrFail($id);
        $brands->delete();
        // session flash
        session()->flash('success', 'Brands deleted!');

        // use sweetalert popup box
        // Alert::success('Brands deleted!');
        // Alert::alert('Title', 'Message');

        return back();

    }
}
