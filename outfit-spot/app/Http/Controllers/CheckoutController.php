<?php

namespace App\Http\Controllers;

use App\Models\ShippingDetails;
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

       $user = $cartservice->getUser();
       $shippingDetails = $user?->shippingDetails;

        $shippingPrices = [
            'ups-standard' => 7,
            'ups-expedited' => 18,
            'dhl-express' => 29,
        ];

       return view('checkout-page', ['countries' => $countries, 'products' => $products, 'user' => $user, 'shippingDetails' =>$shippingDetails, 'shippingDetails' => $shippingDetails, 'shippingPrices' => $shippingPrices]);
    }

    public function shippingDetails(Request $request){
       $cartservice = app(CartService::class);
       $user = $cartservice->getUser();

       if(!$user){ // user is not signed in
            // might want to store if needed, but since we dont have a page which uses it this does nothing right now
       }
       else if($shippingDetails = $user->shippingDetails){ // user has shipping details asociated with him
        $shippingDetails->first_name = $request->input('first_name');
        $shippingDetails->last_name = $request->input('last_name');
        $shippingDetails->email = $request->input('email');
        $shippingDetails->phone = $request->input('phone_number');
        $shippingDetails->country = $request->input('country');
        $shippingDetails->street_address = $request->input('street_address');
        /* $shippingDetails->street_number = $request->input('street_number'); */
        $shippingDetails->city = $request->input('city');
        $shippingDetails->region = $request->input('region');
        $shippingDetails->zip_code = $request->input('zip_code');
        $shippingDetails->save();
       } else { // user does not have any shipping details asociated with him
        $shippingDetails = ShippingDetails::create(['first_name' => $request->input('first_name'), 'last_name' => $request->input('last_name'), 'email' => $request->input('email'), 'phone' => $request->input('phone_number'), 'country_id' => $request->input('country'),
        'street_address' => $request->input('street_address'), 'city' => $request->input('city'), 'region' => $request->input('region'), 'zip_code' => $request->input('zip_code')]);
        $shippingDetails->save();
        $user->saved_shipping_preference = $shippingDetails->id;
        $user->save();
        }
        return redirect()->back();
    }

    public function shippingOption(Request $request){

        return redirect()->back();
    }

    public function payment(){

    }

    public function order(){

    }


    //
}
