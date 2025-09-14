@extends('vendor.vendor_master')


@section('vendor')
{{-- <h1>Manage Products by Vendor</h1> --}}
<!-- Navbar -->
 <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Products</li>
      </ol>
      <h6 class="font-weight-bolder mb-0">Products</h6>
    </nav>
  </div>
</nav>
<!-- End Navbar -->

<br>

<div class="container-fluid py-4">

   <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Products table</h6>
          </div>
        </div>
         <div class="card-body px-0 pb-2">
      
       {{-- Add Products --}}
      
          <!-- Link to add products -->
          <a href="{{ route('vendor.add.products') }}" style="color: white"><button style="width: 40%; margin: 20px 0 20px 10px" type="button" class="btn btn-success">Add New Products</button>
          </a>

          <br>

         <span class="badge rounded-pill bg-info" style="width: 30%; margin-left:20px">Total Products: {{ count($products)}}</span>   

      <div class="card-footer p-3">
        {{-- datatable --}}
        <div class="card-body px-0 pb-2">
          <table id="dataTable" class="table table-striped" style="width:auto">
              <thead>
                  <tr>
                    <th>No.</th>
                    <th>Products</th>
                    <th style="text-align: center">Name</th>
                    {{-- <th> Description</th> --}}
                    <th>Quantity</th>
                    <th> Price</th>
                    <th>Discount</th>
                    <th>Status</th>
                    <th>Action</th>
                      
                  </tr>
              </thead>
              <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset($product->picture) }}" alt="" style="width: 70px; height:40px"></td>
                            <td class="text-capitalize">{{ $product->products_name }}</td>
                            {{-- <td>{{ $product->description }}</td> --}}
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                              @if ($product->discount_price == NULL)
                                   <span class="badge rounded-pill bg-danger">No discount</span>
                              @else
                                  {{-- calculation for discounted price --}}
                                  @php
                                      $calculated = $product->price - $product->discount_price;
                                      $final_amount = ($calculated/$product->price)*100;
                                  @endphp
                                  {{-- display calculation --}}
                                  <span class="badge rounded-pill bg-danger">{{ round($final_amount) }}%</span>

                              @endif
                            <td>
                              @if ($product->status == 1)
                                <span class="badge rounded-pill bg-success">Active</span>
                              @else
                                  <span class="badge rounded-pill bg-danger">Inactive</span>
                              @endif
                            </td>
                            <td>
                              {{-- applied others design instead of words, use icons from font awesome --}}
                              <a href="{{ route('vendor.see.products', $product->id) }}" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="See this products details"><i class="fa-solid fa-eye"></i></a>
                              <a href="{{ route('vendor.edit.products', $product->id) }}" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit this products"><i class="fa-solid fa-pen-to-square"></i></a>
                              <a href="{{ route('vendor.delete.products', $product->id) }}" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete this products"><i class="fa-solid fas fa-trash"></i></a>
                              {{-- <a href="" type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Remove this products"><i class="fas fa-trash"></i></a> --}}
                              <!-- Button trigger modal -->
                              {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Launch demo modal
                              </button> --}}

                              <!-- Modal -->
                              {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      Are you sure you want to delete this products?
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      <a href="{{ route('products.delete', $product->id) }}"><button type="submit" class="btn btn-primary">Yes</button></a>
                                    </div>
                                  </div>
                                </div>
                              </div> --}}
                              {{-- to change products status --}}
                              @if ($product->status == 1)
                                <a href="{{ route('vendor.inactive.products', $product->id) }}" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Deactivate this product"><i class="fa-solid fa-circle-xmark"></i></a>
                              @else
                                <a href="{{ route('vendor.active.products',$product->id) }}" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Activate this product"><i class="fa-solid fa-check"></i></a>
                              @endif
                          </td>
                        
                        </tr>
                    
                    @endforeach  
              </tbody>
          </table>
        </div> 
      </div>
    </div>
         
      </div>
    </div>
  
   
    
</div>




@endsection
