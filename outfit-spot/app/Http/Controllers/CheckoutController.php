<?php

namespace App\Http\Controllers;

use App\Models\ShippingDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Country;
use App\Models\Product;

use App\Services\CartService;
use function Illuminate\Log\log;

class CheckoutController extends Controller
{
    public function index()
    {
        $hideDetails = request()->query('hide-details', false);
        /* dd($hideDetails); */
        $cartservice = app(CartService::class);
        $products = $cartservice->getCart();

        $countries = Country::all();
       /* dd($products, $countries); */

        $user = $cartservice->getUser();

        if($user){
            $shippingDetails = $user?->shippingDetails;
            /* $paymentDetails = $user?->paymentDetails; */
        }else{
             $shippingDetails = session()->get('shippingDetails');
             /* $paymentDetails = session()->get('paymentDetails'); */
        }

       /* dd(($user->shippingDetails)->country_id, $countries[20]); */

        $shippingPrices = [
            'ups-standard' => 7,
            'ups-expedited' => 18,
            'dhl-express' => 29,
        ];

        return view('checkout-page', ['countries' => $countries, 'products' => $products, 'user' => $user, 'shippingDetails' =>$shippingDetails, 'hideDetails'  => $hideDetails, 'shippingPrices' => $shippingPrices]);
    }

    public function shippingDetails(Request $request){
       $cartservice = app(CartService::class);
       $user = $cartservice->getUser();

       if(!$user){ // user is not signed in
           $shippingDetails = array();
           $shippingDetails['first_name'] = $request->input('first_name');
           $shippingDetails['last_name'] = $request->input('last_name');
           $shippingDetails['email'] = $request->input('email');
           $shippingDetails['phone'] = $request->input('phone_number');
           $shippingDetails['country_id'] = $request->input('country');
           $shippingDetails['street_address'] = $request->input('street_address');
           /* $shippingDetails->street_number = $request->input('street_number'); */
           $shippingDetails['city'] = $request->input('city');
           $shippingDetails['region'] = $request->input('region');
           $shippingDetails['zip_code'] = $request->input('zip_code');

           session()->put('shippingDetails', $shippingDetails);
       }
       else if($shippingDetails = $user->shippingDetails){ // user has shipping details asociated with him
        $shippingDetails->first_name = $request->input('first_name');
        $shippingDetails->last_name = $request->input('last_name');
        $shippingDetails->email = $request->input('email');
        $shippingDetails->phone = $request->input('phone_number');
        $shippingDetails->country_id = $request->input('country');
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
        return redirect('/checkout/?hide-details=true');
    }

    public function shippingOption(Request $request){

        return redirect('/checkout');
    }

    public function payment(){

    }

    public function order(Request $request){
        //might want to transfer success/failiure logic into separate routes, and wrap buy into a transaction

        $validator = Validator::make($request->all(), [
            'shipping_options' => ['required'],
            'payment-method' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect('checkout?hide-details=true')
                             ->withErrors($validator)
                             ->withInput();
        }

        $cartservice = app(CartService::class);
        try{
        $cartservice->buy($request->input('shipping_options'), $request->input('payment-method'));
        } catch (\Exception $e){
            switch ($e->getCode()){
            case 2;
                // should log here
                break;
            case 1:
                // should log here
                break;
            default:
                //something is wildly shitty
                // should log / break ?
                throw $e;
                break;
            }
            session()->forget('cart');
            return view('failiure-page', ['clearLocalStorage' => true]);
        }
        return view('success-page', ['clearLocalStorage' => true]);
    }
}
