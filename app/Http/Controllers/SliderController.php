<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class SliderController extends Controller
{
    public function showSlider()
    {

        $sliders = Slider::all();
        return view('admin.slider.slider',compact('sliders'));
    }

    public function addSlider()
    {
        $sliders = Slider::all();
        return view('admin.slider.add-slider',compact('sliders')); 
    }

    public function editSlider($id)
    {
        $editslider = Slider::find($id);
        return view('admin.slider.add-slider', compact('editslider'));
    }

    public function storeslider(Request $request)
    {
        $image = $request->file('slider_image');
        // create unique id with its own image extension(jpeg,png)
        $image_generated = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        // resize image by calling image intervention package
        Image::make($image)->resize(498,498)->save('upload/slider/'.$image_generated);
        $slider_image_url = 'upload/slider/'.$image_generated;

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'slider_image' => $slider_image_url,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // session flash
        session()->flash('success', 'Slider added!');

        return redirect('slider');
    }

    public function updateNewSlider(Request $request)
    {
        $slider_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('slider_image')) {
             $image = $request->file('slider_image');
             $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
             Image::make($image)->resize(300,300)->save('upload/slider/'.$name_gen);
             $save_url = 'upload/slider/'.$name_gen;     
             
             if (file_exists($old_img)) {
                unlink($old_img);
             }
     
             Slider::findOrFail($slider_id)->update([
                 'title' => $request->title,
                 'description' => $request->description,
                 'slider_image' => $save_url, 
             ]);

            session()->flash('success', 'Brands updated!');
            return redirect('slider');

        } else {
            Slider::findOrFail($slider_id)->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            session()->flash('success', 'Slider updated!');
            return redirect('slider');
        }
        
    }

    public function deleteSlider($id)
    {
    //    delete brand function
        $slider = Slider::findOrFail($id);
        $slider->delete();

        // session flash
        session()->flash('success', 'Slider deleted!');

        // use sweetalert popup box
        // Alert::success('slider deleted!');
        // Alert::alert('Title', 'Message');

        return back();

    }
}
