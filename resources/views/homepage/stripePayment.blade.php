@extends('main')

<style>
    body{
    background:#eee;
}

.card {
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: 1rem;
}

.card-body {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.5rem 1.5rem;
}
</style>

@section('main_content')

<div class="card" >
    <div class="card-body">

        <div class="container">
            <h1 class="h3 mb-5">Stripe Payment Gateway</h1>
           <form action="">
            <div class="row">
                <!-- Left -->
               
                <!-- Right -->
                <div class="col-lg-3">
                  <div class="card position-sticky top-0">
                    <div class="p-3 bg-light bg-opacity-10">
                      <h6 class="card-title mb-3">Order Summary</h6>
                      <div class="d-flex justify-content-between mb-1 small">
                        <span>Subtotal</span> <span>RM{{ $cartTotal }}</span>
                      </div>
                      <div class="d-flex justify-content-between mb-1 small">
                        <span>Shipping</span> <span>RM20.00</span>
                      </div>
                      <div class="d-flex justify-content-between mb-1 small">
                        <span>Coupon (Code: NEWYEAR)</span> <span class="text-danger">-$10.00</span>
                      </div>
                      <hr>
                      <div class="d-flex justify-content-between mb-4 small">
                        <span>TOTAL</span> <strong class="text-dark">RM{{ $cartTotal }}</strong>
                      </div>
                      <div class="form-check mb-1 small">
                        <input class="form-check-input" type="checkbox" value="" id="tnc">
                        <label class="form-check-label" for="tnc">
                          I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                      <div class="form-check mb-3 small">
                        <input class="form-check-input" type="checkbox" value="" id="subscribe">
                        <label class="form-check-label" for="subscribe">
                          Get emails about product updates and events. If you change your mind, you can unsubscribe at any time. <a href="#">Privacy Policy</a>
                        </label>
                      </div>
                      <button type="submit" class="btn btn-primary w-100 mt-2">Make Payment</button>
                    </div>
                  </div>
                </div>
              </div>
           </form>
          </div>

        
    </div>
</div>


    
@endsection