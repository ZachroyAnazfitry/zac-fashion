@extends('vendor.vendor_master')

@section('vendor')

<div class="container-fluid">
    <div class="row">

        <div class="card" style="text-align: center">
            <center>
                <img  src="{{ (!empty($vendor->photo)) ? url('upload/vendor-photo/'.$vendor->photo) : url('upload/blank')}}" class="rounded-circle avatar-x1 card-img-top" alt="..." style="width: 10rem">
            </center>
            <div class="card-body">
              {{-- <h5 class="card-title" style="border: 2px solid black;border-radius: 2rem;" >Name: {{ $vendor->name }}</h5>
              <hr>
              <h5 class="card-title" style="border: 2px solid black">Username: {{ $vendor->username }}</h5>
              <hr>
              <h5 class="card-title" style="border: 2px solid black">User Email: {{ $vendor->email }}</h5>
              <hr> --}}
        
              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Vendor/Shop Name</label>
                <input type="text" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="name"  value="{{ $vendor->name }}" readonly>
              </div>
              {{-- username --}}
              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Username</label>
                <input type="text" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="username" value="{{ $vendor->username }}" readonly>
              </div>
              {{-- vendor date --}}
              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Join Date</label>
                <input type="text" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="vendor_register_date" value="{{ $vendor->vendor_register_date }}" readonly>
              </div>
              {{-- vendor info --}}
              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Vendor info</label>
                <textarea class="form-control text-center" style="border: 2px solid black" id="exampleFormControlTextarea1" rows="3"name="vendor_info" readonly>{{ $vendor->vendor_info }}</textarea>
              </div>
              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="email" value="{{ $vendor->email }}" readonly>
              </div>
              <a href="{{ route('vendor.edit') }}" class="btn btn-info">Edit my profile</a>
              {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="" class="btn btn-primary">Go somewhere</a> --}}
            </div>
          </div>

    </div>
</div>
    
@endsection