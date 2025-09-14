@extends('main')

@section('main_content')

<div class="card" >
    <div class="card-body">

        <h1>Cash</h1>
        <div class="card" >
            <div class="card-body">
        
                <div class="row g-5">
                    <form  action="{{ route('checkout.cash.order')  }}" method="post">
                        @csrf

                        <input type="hidden" name="firstName" value="{{ $checkout['firstName'] }}">
                        <input type="hidden" name="lastName" value="{{ $checkout['lastName'] }}">
                        <input type="hidden" name="phone" value="{{ $checkout['phone'] }}">
                        <input type="hidden" name="username" value="{{ $checkout['username'] }}">
                        <input type="hidden" name="email" value="{{ $checkout['email'] }}">
                        <input type="hidden" name="address" value="{{ $checkout['address'] }}">
                        <input type="hidden" name="address2" value="{{ $checkout['address2'] }}">
                        <input type="hidden" name="country" value="{{ $checkout['country'] }}">
                        <input type="hidden" name="state" value="{{ $checkout['state'] }}">
                        <input type="hidden" name="zip" value="{{ $checkout['zip'] }}">

                        <div class="col-md-5 col-lg-4 order-md-last">
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                              <span class="text-primary">Your cart</span>
                              <span class="badge bg-primary rounded-pill">{{$cartQuantity}}</span>
                            </h4>
                            <ul class="list-group mb-3">
                              @foreach ($carts as $cart)
              
                              <li class="list-group-item d-flex justify-content-between lh-sm">
                                  <div>
                                    <h6 class="my-0">{{ $cart->name }}</h6>
                                    <small class="text-muted">Brief description</small>
                                  </div>
                                  <span class="text-info">RM{{ $cart->price }}</span>
                                </li>
                                  
                              @endforeach
                             
                              <li class="list-group-item d-flex justify-content-between bg-light">
                                <div class="text-success">
                                  <h6 class="my-0">Promo code</h6>
                                  <small>EXAMPLECODE</small>
                                </div>
                                <span class="text-success">NA</span>
                                {{-- <span class="text-success">−RM5</span> --}}
                              </li>
                              <li class="list-group-item d-flex justify-content-between">
                                <span>Total (RM)</span>
                                <strong>{{$cartTotal}}</strong>
                              </li>
                            </ul>
                    
                            <button class="w-100 btn btn-primary btn-lg" type="submit">Submit Payment</button>
      
                          </div>
                    </form>                    
                    
                </div>
                
            </div>
        </div> 
        
    </div>
</div> 

    
@endsection