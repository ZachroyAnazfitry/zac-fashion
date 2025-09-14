@extends('admin.admin_master')

@section('admin')

<div class="container-fluid">
    <div class="row">

        <div class="card" style="text-align: center;">
            <center>
                <img id="showPhoto" src="{{ (!empty($admin->photo)) ? url('upload/admin-photo/'.$admin->photo) : url('upload/blank')}}" class="rounded-circle avatar-x1 card-img-top" alt="..." style="width: 18rem">
            </center>
           <div class="row">
              <form action="{{ route('store.profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- profile image --}}
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Profile Image</label>
                  <input type="file" class="form-control text-center" id="photo" style="border: 2px solid black" name="photo"  value="{{ $admin->photo }}">
                </div>
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Name</label>
                  <input type="text" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="name"  value="{{ $admin->name }}">
                </div>
                {{-- username --}}
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Username</label>
                  <input type="text" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="username" value="{{ $admin->username }}">
                </div>
                {{-- email --}}
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Email address</label>
                  <input type="email" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="email" value="{{ $admin->email }}">
                </div>

                <button type="submit" class="btn btn-success">Update my Profile</button>
                <a href="{{ route('admin.profile') }}"><button type="button" class="btn btn-info">Back</button>
                </a>
              </form>
          
            </div>

    </div>
</div>

{{-- move to admin_master blade --}}
{{-- jquery for uploading image --}}

{{-- <script>
  $(document).ready(function(){
    $('#photo').change(function(e){
      var file = e.target.files['0'];
      var reader = new FileReader();
      reader.onload = function(e){
        $('#showPhoto').attr('src', e.target.result);
      }
      reader.readAsDataURL(file);
    })
  })
</script> --}}
    
@endsection