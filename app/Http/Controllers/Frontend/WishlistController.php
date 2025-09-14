<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function wishlist(Request $request, $product_id)
    {
        // condition to chek in login users
        if (Auth::check()) {
            $exist_user = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();

            // if not match ,store data
            if (!$exist_user) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);

                return response()->json(['success' => 'Successfully added in your wishlist.']);
            } else {
                return response()->json(['error' => 'Product already in your wishlist.']);
            }
        } else{
            return response()->json(['error' => 'Please login first before make a wishlist.']);
        }
        
    }

    public function customerWishlist()
    {
       return view('homepage.wishlist');
    }

    public function getWishlist()
    {

        $wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();

        $wishCount = Wishlist::count();

        // pass the 2 variables above
       return response()->json(['wishlist' => $wishlist, 'wishcount' => $wishCount]);
    }

    public function removeWishlist($id)
    {

        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();

        // pass the variables
        return response()->json(['success' => 'Product successfully removed from your wishlist.']);
    }
}
