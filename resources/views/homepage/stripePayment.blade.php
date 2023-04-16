@extends('main')

<style>
   
*/

 /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
 .StripeElement {
  box-sizing: border-box;
  height: 40px;
  padding: 10px 12px;
  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;
  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}
.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}
.StripeElement--invalid {
  border-color: #fa755a;
}
.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;}

</style>

@section('main_content')

<div class="card" >
    <div class="card-body">

        {{-- <div class="container">
            <h1 class="h3 mb-5">Stripe Payment Gateway</h1>
           <form id="payment-form" action="{{ route('checkout.stripe.order') }}" method="POST">
            @csrf
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
                      <button type="submit" id="submit" class="btn btn-primary w-100 mt-2">Pay now</button>
                    </div>
                  </div>
                </div>
              </div>
           </form>
        </div>     --}}
    </div>

    <div class="card-body">
     
      <form action="{{ route('checkout.stripe.order')  }}" method="post" id="payment-form">
        @csrf
        <div class="form-row">
            <label for="card-element">
            Credit or debit card
            </label>

            <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
            </div>
            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>
        </div>
        <br>
        <button class="btn btn-primary">Submit Payment</button>
    </form>
    </div>
</div>

<script type="text/javascript">
  // Create a Stripe client.
var stripe = Stripe('pk_test_51MxLRRF1l0oQf2qDDuhMuLvoaX7VaDUi5PI6KYk5HtWWlDrLE90yoRHpc2FDYHQhMt1rh6VfvmDmG1X84m9cj0HW00Lnxl1sVk');
// Create an instance of Elements.
var elements = stripe.elements();
// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
base: {
  color: '#32325d',
  fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
  fontSmoothing: 'antialiased',
  fontSize: '16px',
  '::placeholder': {
    color: '#aab7c4'
  }
},
invalid: {
  color: '#fa755a',
  iconColor: '#fa755a'
}
};
// Create an instance of the card Element.
var card = elements.create('card', {style: style});
// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');
// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
var displayError = document.getElementById('card-errors');
if (event.error) {
  displayError.textContent = event.error.message;
} else {
  displayError.textContent = '';
}
});
// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
event.preventDefault();
stripe.createToken(card).then(function(result) {
  if (result.error) {
    // Inform the user if there was an error.
    var errorElement = document.getElementById('card-errors');
    errorElement.textContent = result.error.message;
  } else {
    // Send the token to your server.
    stripeTokenHandler(result.token);
  }
});
});
// Submit the form with the token ID.
function stripeTokenHandler(token) {
// Insert the token ID into the form so it gets submitted to the server
var form = document.getElementById('payment-form');
var hiddenInput = document.createElement('input');
hiddenInput.setAttribute('type', 'hidden');
hiddenInput.setAttribute('name', 'stripeToken');
hiddenInput.setAttribute('value', token.id);
form.appendChild(hiddenInput);
// Submit the form
form.submit();
}
</script>
    
@endsection