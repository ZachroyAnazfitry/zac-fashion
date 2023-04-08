@extends('admin.admin_master')

@section('admin')

<!-- Navbar -->
 <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Categories</li>
      </ol>
      <h6 class="font-weight-bolder mb-0">Categories</h6>
    </nav>
  </div>
</nav>
{{-- <h1>Product Categories</h1> --}}

<br>

<div class="container-fluid py-4">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Categories table</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
      
            <div class="table-responsive p-0">
                {{-- Add Categories --}}
           
               <!-- Link to add products -->
               <a href="{{ route('category.add') }}" style="color: white"><button style="width: 40%; margin: 20px 0 20px 10px" type="button" class="btn btn-success">Add New Products Category</button>
               </a>
           
             {{-- datatable --}}
               <table id="dataTable" class="table table-striped align-items-center mb-0">
                   <thead>
                       <tr>
                           <th>Serial No.</th>
                           <th >Product Category Name</th>
                           <th>Product Category Image</th>
                           <th>Action</th>
                           
                       </tr>
                   </thead>
                   <tbody>
                       @foreach ($categories as $category)
                           <tr>
                               <td>{{ $loop->iteration }}</td>
                               <td class="text-uppercase">{{ $category->category_name }}</td>
                               <td><img src="{{ asset($category->category_image) }}" alt="" style="width: 70px; height:40px"></td>
                               <td>
                                   <a href="{{ route('category.edit', $category->id ) }}" class="btn btn-info">Edit</a>
                       
                                   <a href="{{ route('category.delete', $category->id ) }}" class="btn btn-danger">Delete</a>
                               </td>
                           </tr>
                       @endforeach     
                   </tbody>
               </table>
            </div>
           
         </div>
         
      </div>
   
    
</div>


@endsection
