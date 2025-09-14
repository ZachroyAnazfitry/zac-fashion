@extends('admin.admin_master')
@section('admin')

<style>
  input{
    text-transform: uppercase;
  }
  .error {
        color: red;
    }
</style>

<div class="container-fluid">
    <div class="row">

        <div class="card" style="text-align: center;">
           
           <div class="row">
             {{-- using same blade for store & edit --}}
             @if (isset($editslider))
             <form action="{{ route('slider.update', $editslider->id) }}" method="POST" enctype="multipart/form-data">
                 @method('PUT')
             @else
             <form action="{{ route('slider.store') }}" method="POST" id="commentForm" enctype="multipart/form-data">
                @endif
                @csrf
                <div class="card-header card-header-text card-header-info">
                    <div class="card-text">
                        <h1>@if (isset($editslider)) Edit @else Add New @endif Slider</h1>
                    </div>
                </div>

                <div class="mb-3 mt-3">
                    <label for="exampleFormControlInput1" class="form-label">Slider Title</label>
                    <input type="text" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="title" value="{{ old('title', $editslider->title ?? '') }}"
                    @if (isset($editslider))
                    @else
                       required
                    @endif >
                </div>

                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Slider Description</label>
                  <input type="text" class="form-control text-center" id="exampleFormControlInput2" style="border: 2px solid black" name="description" value="{{ old('description', $editslider->description ?? '') }}"
                  @if (isset($editslider))
                  @else
                     required
                  @endif >
              </div>

                {{-- username --}}
                <div class="mb-3 mt-3">
                    <label for="exampleFormControlInput1" class="form-label">Slider Image</label>
                    <input type="file" class="form-control text-center" id="photo" style="border: 2px solid black" name="slider_image" value="{{ old('slider_image', $editslider->slider_image ?? '') }}" 
                    @if (isset($editslider))
                    @else
                       required
                    @endif >
                    @if (isset($editslider))
                        <img id="showPhoto" src="{{ asset($editslider->slider_image) }}" class="rounded-circle avatar-x1 card-img-top" alt="..." style="width: 18rem">
                    @else

                        <img id="showPhoto" src="{{url('upload/admin-photo/blank.jpg')}}" class="rounded-circle avatar-x1 card-img-top" alt="..." style="width: 18rem">      
                    @endif

                </div>

                <a href="{{ route('slider') }}"><button type="button" class="btn btn-info">Back</button>
                <button type="submit" class="btn btn-success">Submit</button>
                
            </form>                                
          
            </div>

    </div>
</div>

<script>
    $("#commentForm").validate({
  rules: {
    title: "required",
    description: "required",
    slider_image: "required",
   
  },
  messages: {
    title: "The title is needed!",
    description: "The description is needed!",
    slider_image: "Please insert an image!",
  }
});
</script>
    
@endsection