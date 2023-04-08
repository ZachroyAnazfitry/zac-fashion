@extends('admin.admin_master')

@section('admin')

<div class="container-fluid">
    <div class="row">

        <div class="card" style="text-align: center;">

          <h2>Edit Brands</h2>
          
           <div class="row">
              <form action="{{ route('brands.update', $brands->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                {{-- profile image --}}
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Brand Name</label>
                  <input type="text" class="form-control text-center" id="brand_name" style="border: 2px solid black" name="brand_name"  value="{{ $brands->brand_name }}">
                </div>
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Brand Image</label>
                  <input type="file" class="form-control text-center" id="photo" style="border: 2px solid black" name="brand_image" value="{{ old('brand_image', $brands->brand_image ?? '') }}" required>
                  <img id="showPhoto" src="{{ asset($brands->brand_image) }}" class="rounded-circle avatar-x1 card-img-top" alt="..." style="width: 18rem">

                </div>


          
                <a href="{{ route('brands') }}"><button type="button" class="btn btn-info">Back</button>
                <button type="submit" class="btn btn-success">Update Brands</button>
                </a>
              </form>
          
            </div>

        </div>
    </div>
</div>

{{-- move to admin_master blade --}}
{{-- jquery for uploading image --}}

{{-- <script>
  $(document).ready(function(){
    $('#photo').change(function(e){
      var file = e.target.files['0'];
      var reader = new FileReader();
      reader.onload = function(e){
        $('#showPhoto').attr('src', e.target.result);
      }
      reader.readAsDataURL(file);
    })
  })
</script> --}}
    
@endsection