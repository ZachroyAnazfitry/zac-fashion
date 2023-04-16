<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function checkoutStripe(Request $request)
    {
        // storing information in metadata
        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51MxLRRF1l0oQf2qDEmC5OTkyLCjlQpJtmSStZQCYyxWoN0fz2Q1JXLthaFvmfsoUEc8pBPLGyGgcfS8c7TsiJWQu00b1Y46CT4');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
        'amount' => 999*100,
        'currency' => 'myr',
        'description' => 'Example charge',
        'source' => $token,
        'metadata' => ['order_id' => '6735'],
        ]);

        // $stripe = new \Stripe\StripeClient("sk_test_51MxLRRF1l0oQf2qDEmC5OTkyLCjlQpJtmSStZQCYyxWoN0fz2Q1JXLthaFvmfsoUEc8pBPLGyGgcfS8c7TsiJWQu00b1Y46CT4");
        // $stripe->charges->create([
        // "amount" => 2000,
        // "currency" => "myr",
        // "source" => "tok_mastercard", // obtained with Stripe.js
        // "metadata" => ["order_id" => "6735"]
        // ]);

        dd($charge);
    }
}
