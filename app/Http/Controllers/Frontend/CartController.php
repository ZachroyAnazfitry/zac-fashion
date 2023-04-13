<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $products = Products::findOrFail($id);

        // for using GET method
        // return response()->json(array(
        //     'products' => $products,
        // ));


        // try {
        //     $products = Products::findOrFail($id);
        // } catch (ModelNotFoundException $e) {
        //     return response()->json(['error' => 'Product not found.'], 404);
        // }

        // for price
        if ($products->discount_price == NULL) {
            Cart::add([
                'id' => $id,
                'name' => $request->products_name,
                'qty' => $request->quantity,
                'color' => $request->color,
                'price' => $request->price,
                'weight' => 1,
            ]);

            return response()->json(['success' => 'Products successfully added.']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $request->products_name,
                'qty' => $request->quantity,
                'color' => $request->color,
                'price' => $request->discount_price,
                'weight' => 1,
            ]);

            return response()->json(['success' => 'Products successfully added.']);
        }
               
    }
}
