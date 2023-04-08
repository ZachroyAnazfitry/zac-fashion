@extends('admin.admin_master')

<style>
  input, textarea{
    text-transform: uppercase;
  }
</style>

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<h1>New Products</h1>

<br>

<div class="container-fluid">
  <div class="row">

      <div class="card" style="text-align: center;">

        <div class="card-header card-header-text card-header-primary">
          <div class="card-text">
            <h4 class="card-title">Adding New Products</h4>
          </div>
        </div>

        {{-- <h2>Adding New Products</h2> --}}
        
         <div class="card-body">
          <div class="row">
            <form action="{{ route('products.store') }}" method="POST" id="validateProductsForm" enctype="multipart/form-data">
             
              @csrf

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Brand</label>
                <select class="form-select text-center" style="border: 2px solid black" name="brands_id" aria-label="Default select example" required>
                  <option selected disabled>Select the Brands</option>

                  @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->brand_name}}</option>    
                  @endforeach
                  
                </select>
                {{-- <input type="text" class="form-control text-center" id="brand_name" style="border: 2px solid black" name="brands_id"  > --}}
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Category</label>
                <select class="form-select text-center" style="border: 2px solid black" name="category_id" aria-label="Default select example">
                  <option selected disabled>Select the Categories</option>

                  @foreach ($categories as $category)
                  <option value="{{$category->id}}">{{ $category->category_name}}</option>    
                  @endforeach
                  
                </select>
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Sub Category</label>
                <input type="text" class="form-control text-center" id="brand_name" style="border: 2px solid black" name="sub_category_id"  >
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Vendor</label>
                <select class="form-select text-center" style="border: 2px solid black" name="vendor_id" aria-label="Default select example">
                  <option selected disabled>Select the Vendor</option>

                  @foreach ($activeVendor as $vendor)
                  <option value="{{$vendor->id}}">{{ $vendor->name}}</option>    
                  @endforeach
                  
                </select>
              </div>

              {{-- <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Brand</label>
                <input type="text" class="form-control text-center" id="brand_name" style="border: 2px solid black" name="brands_id"  >
              </div> --}}
              
              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Name</label>
                <input type="text" class="form-control text-center" id="products_name" style="border: 2px solid black" name="products_name"  >
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Code</label>
                <input type="text" class="form-control text-center" id="code" style="border: 2px solid black" name="code"  >
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Quantity</label>
                <input type="number" min="0" class="form-control text-center" id="quantity" style="border: 2px solid black" name="quantity"  >
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Tags</label>
                <input type="text" class="form-control text-center" id="tags" style="border: 2px solid black" name="tags"  >
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Size</label>
                <select class="form-select text-center" style="border: 2px solid black" name="size" aria-label="Default select example" required>
                  <option selected disabled>Select the Brands</option>
                  <option value="1">S</option>
                  <option value="2">M</option>
                  <option value="3">L</option>
                  <option value="4">XL</option>
                  
                </select>
                {{-- <input type="text" class="form-control text-center" id="size" style="border: 2px solid black" name="size"  > --}}
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Color</label>
                <input type="text" class="form-control text-center" id="color" style="border: 2px solid black" name="color"  >
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Description</label>
                <textarea class="form-control text-center" style="border: 2px solid black" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Images</label>
                <input type="file" class="form-control text-center" style="border: 2px solid black"
                       onchange="prod(this)" name="picture" required >

                {{-- display image --}}
                <img src="" id="prodPic">
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Thumbnails</label>
                <input type="file" class="form-control text-center" style="border: 2px solid black"
                       id="thumb" name="thumbnails[]" multiple placeholder="Upload your products images" >

                {{-- display multiple images --}}
                <div class="row" id="imgThumb">

                </div>
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Price (RM)</label>
                <input type="text" class="form-control text-center" id="price" style="border: 2px solid black" name="price" multiple  >
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Discount Price (RM)</label>
                <input type="text" class="form-control text-center" id="discount_price" style="border: 2px solid black" name="discount_price" multiple  >
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Special Offer</label>
                <input type="text" class="form-control text-center" id="special_offer" style="border: 2px solid black" name="special_offer" multiple  >
              </div>

              {{-- checkbox --}}
              <div class="row g-3">
                <div class="col md-6">
                  <div class="form-check">
                    <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      Hot Deals
                    </label>
                  </div>
                </div>

                {{-- <div class="col md-6">
                  <div class="form-check">
                    <input class="form-check-input" name="specification" type="checkbox" value="1" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      Features
                    </label>
                  </div>
                </div> --}}

                <div class="col md-6">
                  <div class="form-check">
                    <input class="form-check-input" name="special_offer" type="checkbox" value="1" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      Special Offer
                    </label>
                  </div>
                </div>

              </div>

              <br>
              
        
              <a href="{{ route('products.manage') }}"><button type="button" class="btn btn-info">Back</button>
              <button type="submit" class="btn btn-success">Add new products</button>
              </a>
            </form>
        
          </div>
         </div>

      </div>
  </div>
</div>

{{-- thumbnails --}}
<script>
  function prod(input) {
    // condition
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e){
        $('#prodPic').attr('src', e.target.result).width(80).height(80);

      };
      reader.readAsDataURL(input.files[0]);
      
    } 
  }

</script>

{{-- for multiple images(thumbnails) --}}
<script> 
 
  $(document).ready(function(){
   $('#thumb').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                  .height(80); //create image element 
                      $('#imgThumb').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
   
  </script>

  {{-- validation --}}
  <script>
    $("#validateProductsForm").validate({
  rules: {
    products_name: "required",
    code: "required",
   
  },
  messages: {
    products_name: "The products  name is needed!",
    code: "Please insert the code!",

  }
});
</script>



@endsection
