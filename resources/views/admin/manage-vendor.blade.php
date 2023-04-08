@extends('admin.admin_master')

@section('admin')
<h1>Manage Vendors or Sellers</h1>

<br>

<section>
  <div class="card-body">
    
    <div class="card">
        <div class="card-header card-header-danger">
            <h4 class="card-title">Vendor Information</h4>
            {{-- <p class="category">Category subtitle</p> --}}
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
                  @foreach ($active_vendor as $active)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $active->name }}</td>
                          <td>{{ $active->username }}</td>
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


</section>


@endsection
