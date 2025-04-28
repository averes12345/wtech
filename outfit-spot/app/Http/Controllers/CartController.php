<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;

class CartController extends Controller
{
     public function update(Request $request, $id){
        $newQuantity = max(0, $request->input('quantity'));

        $cartservice = app(CartService::class);
        $quantity = $cartservice->getItemQuantity($id);
        if($newQuantity < $quantity){
            $cartservice->remove($id, $quantity - $newQuantity);
        } else {
            $cartservice->add($id, $newQuantity - $quantity);
        }
        if($cartservice->getItemQuantity($id) == 0){
            // might want to call the cart helper
            $this->destroy($request, $id);
        }
       return redirect()->back();
    }


    public function destroy(Request $request, $id){
       $cartservice = app(CartService::class);
       $cartservice->delete($id);
        return redirect()->back();
        /* dd('success'); */
    }

}
