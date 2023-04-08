@extends('admin.admin_master')

@section('admin')
<h1>Product Categories</h1>

<br>

<div class="container">
  
    <div class="card">
      
       {{-- Add brands --}}
      
          <!-- Link to add products -->
          <a href="{{ route('category.add') }}" style="color: white"><button style="width: 40%; margin: 20px 0 20px 10px" type="button" class="btn btn-primary">Add New Products Category</button>
          </a>
      

      <div class="card-footer p-3">
        {{-- datatable --}}
        <div class="card-body">
          <table id="dataTable" class="table table-striped" style="width:100%">
              <thead>
                  <tr>
                      <th>Serial No.</th>
                      <th>Product Category Name</th>
                      <th>Product Category Image</th>
                      <th>Action</th>
                      
                  </tr>
              </thead>
              <tbody>
                  @foreach ($categories as $category)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $category->category_name }}</td>
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
