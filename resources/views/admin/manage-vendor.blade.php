@extends('admin.admin_master')

@section('admin')
{{-- <h1>Manage Vendors or Sellers</h1> --}}
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Vendors/Sellers</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Vendors/Sellers</h6>
      </nav>
    </div>
  </nav>

<br>

<div class="container-fluid py-4">

    <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Vendors/Sellers Information table</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <table id="dataTable" class="table table-striped align-items-center mb-0">
              <thead>
                  <tr>
                      <th>No.</th>
                      <th>Shop Name</th>
                      <th>Username</th>
                      <th>Registered Date</th>
                      <th>Status</th>
                      <th>Action</th>
                      
                  </tr>
              </thead>
              <tbody>
                  @foreach ($active_vendor as $active)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td class="text-capitalize">{{ $active->name }}</td>
                          <td class="text-capitalize">{{ $active->username }}</td>
                          <td>{{ $active->vendor_register_date }}</td>
                          <td>
                              @if ($active->status == 'inactive')
                                <button type="button" class="btn btn-danger">{{ $active->status }}</button>
                              @else
                              <a href="{{ route('admin.details_active_vendor', $active->id) }}"><button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Click to deactivate">{{ $active->status }}</button>
                              </a>
                              @endif
                          </td>
                          {{-- <td><button type="button" class="btn btn-info">{{ $active->status }}</button></td> --}}
                          <td>
                              <a href="{{ route('admin.details_vendor', $active->id) }}" class="btn btn-info">Details</a>
                          </td>
                      </tr>
                      
                  @endforeach
                  
                </tbody>
                <tfoot>
                    
                </tfoot>
            </table>
        </div>
           
        </div>
      </div>
   

</div>

  
 
</div>


  
  {{-- inactive veodr datatable --}}
  {{-- <div class="card-body">
    
      <div class="card">
          <div class="card-header card-header-danger">
              <h4 class="card-title">Inactive Seller</h4>
              <p class="category">Category subtitle</p>
          </div>
          <div class="card-body">
              <table id="dataTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Shop Name</th>
                        <th>Username</th>
                        <th>Registered Date</th>
                        <th>Status</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inactive_vendor as $inactive)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $inactive->name }}</td>
                            <td>{{ $inactive->username }}</td>
                            <td>{{ $inactive->vendor_register_date }}</td>
                            <td>{{ $inactive->status }}</td>
                            <td>
                                <a href="" class="btn btn-info">Details</a>
                            </td>
                        </tr>
                        
                    @endforeach
                    
                  </tbody>
                  <tfoot>
                      
                  </tfoot>
              </table>
          </div>
      </div>
   
  </div> --}}





@endsection
