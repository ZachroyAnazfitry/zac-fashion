@extends('admin.admin_master')

<style>
    #row1{
        margin: 0 auto;
        width: 100px;
    }

</style>

@section('admin')

<div class="container-fluid">
    <div class="row">

         {{-- display error message --}}
         @if (count($errors))
         @foreach ($errors->all() as $error)
         {{-- bootstrap class --}}
             <div class="alert alert-danger" role="alert">
             {{ $error }}
             </div>
         @endforeach              
         @endif

        <div class="card" id="row1" style="text-align: center; width: 18rem">
           <div class="row" >

           

              <form action="{{ route('password.profile') }}" method="POST">
                @csrf
                <div class="mb-3 mt-3">
                  <label for="exampleFormControlInput1" class="form-label">Old Password</label>
                  <input type="password" class="form-control text-center" style="border: 2px solid black;" id="old_password" name="old_password">
                </div>

                <div class="mb-3 mt-3">
                    <label for="exampleFormControlInput1" class="form-label">New Password</label>
                    <input type="password" class="form-control text-center" style="border: 2px solid black;" id="new_password" name="new_password">
                </div>

                <div class="mb-3 mt-3">
                    <label for="exampleFormControlInput1" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control text-center" style="border: 2px solid black;" id="confirm_password" name="confirm_password">
                </div>
              
                <button type="submit" class="btn btn-secondary">Change password</button>
              </form>
          
            </div>

    </div>
</div>
    
@endsection