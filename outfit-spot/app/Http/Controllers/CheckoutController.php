<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Product;
use App\Services\CartService;

class CheckoutController extends Controller
{
    public function index()
    {
       $cartservice = app(CartService::class);
       $cart = $cartservice->getCart();

        $products = Product::with([
            /* 'categories', */ /* dont need the categories for the checkout page */
            'colorSizeVariants.color',
            'colorSizeVariants.size',
            /* 'colorSizeVariants.images' */ /* we need one image for each of the combination combos, this however pulls all */
        ])->whereIn('id', array_keys($cart))->get();
        $products->each(function ($product) use ($cart) {
            $product->cart_quantity = $cart[$product->id]['quantity'] ?? 0; /* should never be null */
        });
        $countries = Country::all();


        return view('checkout-page', ['countries' => $countries, 'products' => $products]);
    }

    public function update(Request $request, $id){
        $newQuantity = max(0, $request->input('quantity'));
        $cartservice = app(CartService::class);
        /* $cartservice->  update quantity */

       return redirect()->back();
    }

    public function destroy($id){

        return redirect()->back();
    }

    //
}
