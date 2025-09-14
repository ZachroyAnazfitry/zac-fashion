@extends('vendor.vendor_master')

@section('vendor')

<div class="container-fluid">
    <div class="row">

        <div class="card" style="text-align: center;">
            <center>
                <img id="showPhoto" src="{{ (!empty($vendor->photo)) ? url('upload/vendor-photo/'.$vendor->photo) : url('upload/blank')}}" class="rounded-circle avatar-x1 card-img-top" alt="..." style="width: 18rem">
            </center>
           <div class="row">
              <form action="{{ route('store.vendorProfile') }}" method="POST" enctype="multipart/form-data">
                @csrf 
                {{-- profile image --}}
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Profile Image</label>
                  <input type="file" class="form-control text-center" id="photo" style="border: 2px solid black" name="photo"  value="{{ $vendor->photo }}">
                </div>
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Vendor/Shop Name</label>
                  <input type="text" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="name"  value="{{ $vendor->name }}">
                </div>
                {{-- username --}}
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Username</label>
                  <input type="text" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="username" value="{{ $vendor->username }}">
                </div>
                {{-- vendor date --}}
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Join Date</label>
                  <input type="date" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="vendor_register_date" value="{{ $vendor->vendor_register_date }}">
                </div>
                {{-- vendor info --}}
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Vendor info</label>
                 
                    <textarea class="form-control text-center" style="border: 2px solid black" id="exampleFormControlTextarea1" rows="3"name="vendor_info">{{ $vendor->vendor_info }}</textarea>
                 
                  {{-- <input type="text" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="vendor_info" value="{{ $vendor->vendor_info }}"> --}}
                </div>
                {{-- email --}}
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Email address</label>
                  <input type="email" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="email" value="{{ $vendor->email }}">
                </div>

                <button type="submit" class="btn btn-success">Update my Profile</button>
                <a href="{{ route('vendor.profile') }}"><button type="button" class="btn btn-info">Back</button>
                </a>
              </form>
          
            </div>

    </div>
</div>

    
@endsection