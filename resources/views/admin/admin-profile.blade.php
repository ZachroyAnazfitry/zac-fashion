@extends('admin.admin_master')

@section('admin')

<div class="container-fluid">
    <div class="row">

        <div class="card" style="text-align: center">
            <center>
                <img  src="{{ (!empty($admin->photo)) ? url('upload/admin-photo/'.$admin->photo) : url('upload/blank')}}" class="rounded-circle avatar-x1 card-img-top" alt="..." style="width: 10rem">
            </center>
            <div class="card-body">
              {{-- <h5 class="card-title" style="border: 2px solid black;border-radius: 2rem;" >Name: {{ $admin->name }}</h5>
              <hr>
              <h5 class="card-title" style="border: 2px solid black">Username: {{ $admin->username }}</h5>
              <hr>
              <h5 class="card-title" style="border: 2px solid black">User Email: {{ $admin->email }}</h5>
              <hr> --}}
        
              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input type="text" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="name"  value="{{ $admin->name }}" readonly>
              </div>
              {{-- username --}}
              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Username</label>
                <input type="text" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="username" value="{{ $admin->username }}" readonly>
              </div>
              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="email" value="{{ $admin->email }}" readonly>
              </div>
              <a href="{{ route('admin.edit') }}" class="btn btn-info">Edit my profile</a>
              {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="" class="btn btn-primary">Go somewhere</a> --}}
            </div>
          </div>

    </div>
</div>
    
@endsection