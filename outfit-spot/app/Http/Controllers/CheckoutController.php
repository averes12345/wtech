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
       $products = $cartservice->getCart();

       $countries = Country::all();
       /* dd($products, $countries); */


        return view('checkout-page', ['countries' => $countries, 'products' => $products]);
    }


    //
}
