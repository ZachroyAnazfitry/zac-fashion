@extends('vendor.vendor_master')


@section('vendor')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<h1>New Products</h1>

<br>

<div class="container-fluid">
  <div class="row">

      <div class="card" style="text-align: center;">

        <div class="card-header card-header-text card-header-primary">
          <div class="card-text">
            @if (isset($see_products))
                <h4 class="card-title">Products Overview</h4>
            @else
                <h4 class="card-title">Adding New Products</h4>
            @endif
          </div>
        </div>

        {{-- <h2>Adding New Products</h2> --}}
        
         <div class="card-body">
          <div class="row">
            @if (isset($see_products))
                
            @else
              <form action="{{ route('vendor.update.products', $products->id) }}" method="POST" id="validateProductsForm" enctype="multipart/form-data">
              @method('PUT')
            @endif
             
              @csrf

              @if (isset($see_products))
                  
              @else
              <input type="hidden" name="id" value="{{  $products->id }}">
              @endif
              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Brand</label>
                @if (isset($see_products))
                    @foreach ($brands as $brand)
                        <input type="text" class="form-control text-center" id="brands_id" style="border: 2px solid black" name="brands_id" value="{{ $brand->brand_name}}" readonly  >
                    @endforeach
                @else
                    <select class="form-select text-center" style="border: 2px solid black" name="brands_id" aria-label="Default select example" required>
                      {{-- <option selected disabled>{{ $brand->brand_name}}</option> --}}

                      @foreach ($brands as $brand)
                        <option selected value="{{ $brand->id }}">{{ $brand->brand_name}}</option>    
                      @endforeach
                      
                    </select>
                @endif
              
                {{-- <input type="text" class="form-control text-center" id="brand_name" style="border: 2px solid black" name="brands_id"  > --}}
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Category</label>
                @if (isset($see_products))
                    @foreach ($categories as $category)
                          <input type="text" class="form-control text-center" id="brands_id" style="border: 2px solid black" name="brands_id" value="{{ $category->category_name}}" readonly  >
                    @endforeach
                @else

                    <select class="form-select text-center" style="border: 2px solid black" name="category_id" aria-label="Default select example">
                      {{-- <option selected disabled>Select the Categories</option> --}}

                      @foreach ($categories as $category)
                      <option value="{{$category->id}}">{{ $category->category_name}}</option>    
                      @endforeach
                      
                    </select>
                    
                @endif
               
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Sub Category</label>
                <input type="text" class="form-control text-center" id="brand_name" style="border: 2px solid black" name="sub_category_id" 
                 @if (isset($see_products))
                    value="{{ $see_products->sub_category_id}}" readonly
                 @else
                    value="{{ $products->sub_category_id}}"
                 @endif
                >
              </div>


              {{-- <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Brand</label>
                <input type="text" class="form-control text-center" id="brand_name" style="border: 2px solid black" name="brands_id"  >
              </div> --}}
              
              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Name</label>
                <input type="text" class="form-control text-center" id="products_name" style="border: 2px solid black" name="products_name"
                @if (isset($see_products))
                    value="{{ $see_products->products_name}}" readonly
                 @else
                    value="{{ $products->products_name}}"
                 @endif >
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Code</label>
                <input type="text" class="form-control text-center" id="code" style="border: 2px solid black" name="code"
                @if (isset($see_products))
                    value="{{ $see_products->code}}" readonly
                 @else
                    value="{{ $products->code}}"
                 @endif >
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Quantity</label>
                <input type="number" min="0" class="form-control text-center" id="quantity" style="border: 2px solid black" name="quantity" 
                @if (isset($see_products))
                    value="{{ $see_products->quantity}}" readonly
                 @else
                    value="{{ $products->quantity}}"
                 @endif >
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Tags</label>
                <input type="text" class="form-control text-center" id="tags" style="border: 2px solid black" name="tags"
                @if (isset($see_products))
                    value="{{ $see_products->tags}}" readonly
                 @else
                    value="{{ $products->tags}}"
                 @endif >
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Size</label>
                <input type="text" class="form-control text-center" id="size" style="border: 2px solid black" name="size"
                @if (isset($see_products))
                    value="{{ $see_products->size}}" readonly
                 @else
                    value="{{ $products->size}}"
                 @endif >
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Color</label>
                <input type="text" class="form-control text-center" id="color" style="border: 2px solid black" name="color"
                @if (isset($see_products))
                    value="{{ $see_products->color}}" readonly
                 @else
                    value="{{ $products->color}}"
                 @endif >
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Description</label>
                @if (isset($see_products))
                  <textarea class="form-control text-center" style="border: 2px solid black" id="exampleFormControlTextarea1" rows="3" name="description" readonly>{{ $see_products->description }}</textarea>

                @else
                    <textarea class="form-control text-center" style="border: 2px solid black" id="exampleFormControlTextarea1" rows="3" name="description">{{ $products->description }}</textarea>
                @endif
              </div>

              

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Price (RM)</label>
                <input type="text" class="form-control text-center" id="price" style="border: 2px solid black" name="price"
                @if (isset($see_products))
                value="{{ $see_products->price}}" readonly
                @else
                    value="{{ $products->price}}"
                @endif >
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Discount Price (RM)</label>
                <input type="text" class="form-control text-center" id="discount_price" style="border: 2px solid black" name="discount_price"
                @if (isset($see_products))
                value="{{ $see_products->discount_price}}" readonly
                @else
                    value="{{ $products->discount_price}}"
                @endif >
              </div>

              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Products Special Offer</label>
                <input type="text" class="form-control text-center" id="special_offer" style="border: 2px solid black" name="special_offer"
                @if (isset($see_products))
                value="{{ $see_products->special_offer}}" readonly
                @else
                    value="{{ $products->special_offer}}"
                @endif >
              </div>

              {{-- checkbox --}}
              <div class="row g-3">
                <div class="col md-6">
                  <div class="form-check">
                    @if (isset($see_products))
                        @if ($see_products->hot_deals == 1)
                          <input class="form-check-input" name="hot_deals" type="checkbox" id="flexCheckDefault"  value="1" checked >
                        @else
                          <input class="form-check-input" name="hot_deals" type="checkbox" id="flexCheckDefault"  value="0" >
                        @endif
                    @else
                        @if ($products->hot_deals == 1)
                          <input class="form-check-input" name="hot_deals" type="checkbox" id="flexCheckDefault"  value="1" checked >
                        @else
                          <input class="form-check-input" name="hot_deals" type="checkbox" id="flexCheckDefault"  value="0"  >
                        @endif       
                    @endif
                    <label class="form-check-label" for="flexCheckDefault">
                      Hot Deals
                    </label>
                  </div>
                </div>

                {{-- <div class="col md-6">
                  <div class="form-check">
                    @if (isset($see_products))
                    @if ($see_products->specification == 1)
                      <input class="form-check-input" name="specification" type="checkbox" id="flexCheckDefault"  value="1" checked >
                    @else
                      <input class="form-check-input" name="specification" type="checkbox" id="flexCheckDefault"  value="0" >
                    @endif
                    @else
                        @if ($products->specification == 1)
                          <input class="form-check-input" name="specification" type="checkbox" id="flexCheckDefault"  value="1" checked >
                        @else
                          <input class="form-check-input" name="specification" type="checkbox" id="flexCheckDefault"  value="0"  >
                        @endif       
                    @endif
                    <label class="form-check-label" for="flexCheckDefault">
                      Features
                    </label>
                  </div>
                </div> --}}

                <div class="col md-6">
                  <div class="form-check">
                    @if (isset($see_products))
                    @if ($see_products->special_offer == 1)
                      <input class="form-check-input" name="special_offer" type="checkbox" id="flexCheckDefault"  value="1" checked >
                    @else
                      <input class="form-check-input" name="special_offer" type="checkbox" id="flexCheckDefault"  value="0" >
                    @endif
                    @else
                        @if ($products->special_offer == 1)
                          <input class="form-check-input" name="special_offer" type="checkbox" id="flexCheckDefault"  value="1" checked >
                        @else
                          <input class="form-check-input" name="special_offer" type="checkbox" id="flexCheckDefault"  value="0"  >
                        @endif       
                    @endif
                    {{-- <input class="form-check-input" name="special_offer" type="checkbox" id="flexCheckDefault"  value="1" > --}}
                    <label class="form-check-label" for="flexCheckDefault">
                      Special Offer
                    </label>
                  </div>
                </div>

              </div>

              <br>

              <a href="{{ route('vendor.all.products') }}"><button type="button" class="btn btn-info">Back</button>
                @if (isset($see_products))
                    
                @else                                          
                  <button type="submit" class="btn btn-success">Save changes</button>
                @endif
              </a>
            </form>
        
          </div>
         </div>

      </div>

      <br>

      {{-- update picture & thumbnails - hold --}}

      {{-- <div class="card" style="margin: 10px 0 10px 0">
        <div class="card-body">
          @if (isset($see_products))
              
          @else 

          <form action="{{ route('products.update.images', $products->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$products->id}}" >
            <input type="hidden" name="old_img" value="{{$products->id}}" >
              
          @endif
          
            <div class="mb-3">
              @if (isset($see_products))
              @else
                <label for="formFile" class="form-label" style="text-align: center">New Image</label>
                <input class="form-control" type="file" name="picture" id="formFile" style="border: 2px solid black;">
              @endif
            </div>

            
            <div class="mb-3">
              <label for="formFile" class="form-label" style="text-align: center">Current Products Icon</label>
              @if (isset($see_products))
                <img src="{{ asset($see_products->picture) }}" alt="" class="form-control" style="width: 100px; height:100px">
              @else
                <img src="{{ asset($products->picture) }}" alt="" class="form-control" style="width: 100px; height:100px">
              @endif
            </div>

            
            <a href="{{ route('vendor.all.products') }}"><button type="button" class="btn btn-info">Back</button>
              @if (isset($see_products))
                  
              @else
                <button type="submit" class="btn btn-success">Save changes</button>
              @endif
            </a>

          </form>
        </div>
      </div> --}}
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
