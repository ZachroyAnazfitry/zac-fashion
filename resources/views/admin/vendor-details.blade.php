@extends('admin.admin_master')

@section('admin')

<div class="container-fluid">
  <div class="row">

      <div class="card" style="text-align: center">
          <center>
              <img  src="{{ (!empty($inactive_vendor->photo)) ? url('upload/vendor-photo/'.$inactive_vendor->photo) : url('upload/blank')}}" class="rounded-circle avatar-x1 card-img-top" alt="..." style="width: 10rem">
          </center>
          <div class="card-body">

            <form action="{{ route('admin.activate_vendor',$inactive_vendor->id ) }}" method="POST">
              @csrf

              <input type="hidden" name="id" value="{{ $inactive_vendor->id  }}">
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Vendor/Shop Name</label>
                  <input type="text" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="name"  value="{{ $inactive_vendor->name }}" readonly>
                </div>
                {{-- username --}}
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Username</label>
                  <input type="text" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="username" value="{{ $inactive_vendor->username }}" readonly>
                </div>
                {{-- vendor date --}}
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Join Date</label>
                  <input type="text" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="vendor_register_date" value="{{ $inactive_vendor->vendor_register_date }}" readonly>
                </div>
                {{-- vendor info --}}
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Vendor info</label>
                  <textarea class="form-control text-center" style="border: 2px solid black" id="exampleFormControlTextarea1" rows="3"name="vendor_info" readonly>{{ $inactive_vendor->vendor_info }}</textarea>
                </div>
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Email address</label>
                  <input type="email" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="email" value="{{ $inactive_vendor->email }}" readonly>
                </div>
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
                  <input type="email" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="phone" value="{{ $inactive_vendor->phone }}" readonly>
                </div>
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Address</label>
                  <textarea class="form-control text-center" style="border: 2px solid black" id="exampleFormControlTextarea1" rows="3"name="address" readonly>{{ $inactive_vendor->address }}</textarea>
                </div>
                {{-- status --}}
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Vendor Status</label>
                  <input type="text" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="status"  value="{{ $inactive_vendor->status }}" readonly>
                </div>
    
                {{-- button and links --}}
                <a href="{{ route('admin.manage_vendor') }}"><button type="button" class="btn btn-info">Back</button>

                @if ($inactive_vendor->status == 'inactive')
                    <button type="submit" class="btn btn-success">Activate Vendor</button>
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