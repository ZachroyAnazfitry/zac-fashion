@extends('admin.admin_master')

@section('admin')

<div class="container-fluid">
  <div class="row">

      <div class="card" style="text-align: center">
          <center>
              <img  src="{{ (!empty($active_vendor->photo)) ? url('upload/vendor-photo/'.$active_vendor->photo) : url('upload/blank')}}" class="rounded-circle avatar-x1 card-img-top" alt="..." style="width: 10rem">
          </center>
          <div class="card-body">

            <form action="{{ route('admin.deactivate_vendor',$active_vendor->id ) }}" method="POST">
              @csrf

              <input type="hidden" name="id" value="{{ $active_vendor->id  }}">
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Vendor/Shop Name</label>
                  <input type="text" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="name"  value="{{ $active_vendor->name }}" readonly>
                </div>
                {{-- username --}}
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Username</label>
                  <input type="text" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="username" value="{{ $active_vendor->username }}" readonly>
                </div>
                {{-- vendor date --}}
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Join Date</label>
                  <input type="text" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="vendor_register_date" value="{{ $active_vendor->vendor_register_date }}" readonly>
                </div>
                {{-- vendor info --}}
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Vendor info</label>
                  <textarea class="form-control text-center" style="border: 2px solid black" id="exampleFormControlTextarea1" rows="3"name="vendor_info" readonly>{{ $active_vendor->vendor_info }}</textarea>
                </div>
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Email address</label>
                  <input type="email" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="email" value="{{ $active_vendor->email }}" readonly>
                </div>
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
                  <input type="email" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="phone" value="{{ $active_vendor->phone }}" readonly>
                </div>
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Address</label>
                  <textarea class="form-control text-center" style="border: 2px solid black" id="exampleFormControlTextarea1" rows="3"name="address" readonly>{{ $active_vendor->address }}</textarea>
                </div>
                {{-- status --}}
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Vendor Status</label>
                  <input type="text" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="status"  value="{{ $active_vendor->status }}" readonly>
                </div>
    
                {{-- button and links --}}
                <a href="{{ route('admin.manage_vendor') }}"><button type="button" class="btn btn-info">Back</button>

                @if ($active_vendor->status == 'active')
                    <button type="submit" class="btn btn-danger">Deactivate Vendor</button>
                @endif

                  {{-- @if ($inactive_vendor->status == 'inactive'))
                      <button type="submit" class="btn btn-success">Activate Vendor</button>
                  @else
                      <button type="submit" class="btn btn-danger">Deactivate Vendor</button>                      
                  @endif --}}
                  
              </form>
    
          </div>
      </div>

  </div>
</div>

    
@endsection