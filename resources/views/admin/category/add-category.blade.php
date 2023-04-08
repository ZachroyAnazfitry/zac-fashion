@extends('admin.admin_master')
@section('admin')

<style>
  input{
    text-transform: uppercase;
  }
</style>

<div class="container-fluid">
    <div class="row">

        <div class="card" style="text-align: center;">
           
           <div class="row">
             {{-- using same blade for store & edit --}}
             @if (isset($editCategory))
             <form action="{{ route('category.update', $editCategory->id) }}" method="POST" enctype="multipart/form-data">
                 @method('PUT')
             @else
             <form action="{{ route('category.store') }}" method="POST" id="commentForm" enctype="multipart/form-data">
                @endif
                @csrf
                <div class="card-header card-header-text card-header-info">
                    <div class="card-text">
                        <h1>@if (isset($editCategory)) Edit @else Add New @endif Products Category</h1>
                    </div>
                </div>

                <div class="mb-3 mt-3">
                    <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                    <input type="text" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="category_name" value="{{ old('category_name', $editCategory->category_name ?? '') }}"
                    @if (isset($editCategory))
                    @else
                       required
                    @endif >
                </div>
                {{-- username --}}
                <div class="mb-3 mt-3">
                    <label for="exampleFormControlInput1" class="form-label">Category Image</label>
                    <input type="file" class="form-control text-center" id="photo" style="border: 2px solid black" name="category_image" value="{{ old('category_image', $editCategory->category_image ?? '') }}" 
                    @if (isset($editCategory))
                    @else
                       required
                    @endif >
                    @if (isset($editCategory))
                        <img id="showPhoto" src="{{ asset($editCategory->category_image) }}" class="rounded-circle avatar-x1 card-img-top" alt="..." style="width: 18rem">
                    @else

                        <img id="showPhoto" src="{{url('upload/admin-photo/blank.jpg')}}" class="rounded-circle avatar-x1 card-img-top" alt="..." style="width: 18rem">      
                    @endif

                </div>

                <a href="{{ route('category') }}"><button type="button" class="btn btn-info">Back</button>
                <button type="submit" class="btn btn-success">Submit</button>
                
            </form>                                
          
            </div>

    </div>
</div>

<script>
    $("#commentForm").validate({
  rules: {
    category_name: "required",
    category_image: "required",
    email: {
      required: true,
      email: true
    }
  },
  messages: {
    category_name: "The category name is needed!",
    category_image: "Please insert an image!",
    email: {
      required: "We need your email address to contact you",
      email: "Your email address must be in the format of name@domain.com"
    }
  }
});
</script>
    
@endsection