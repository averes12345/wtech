<?php

namespace App\Services;

use App\Models\User;
use App\Models\Product;

use Illuminate\Support\Facades\Auth;

class CartService
{
    /**
     * Create a new class instance.
     */
    public function getUser(){
        return Auth::user() ?? Auth::guard('admin')->user();
    }

    public function add(int $productVariantId, int $quantity = 1): void /* quantity has to be unsigned */
    {
        $user = $this->getUser();
        if($user){

           /* $this is where I should update the cart in the database */
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$productVariantId ])){
                $cart[$productVariantId ]['quantity'] += $quantity;
            } else {
                $cart[$productVariantId] = [
                    'quantity' => $quantity,
                ];
            }

            session()->put('cart',$cart);
        }
    }

    public function remove(int $productVariantId, int $quantity = 1) :void /* quantity has to be unsigned */
    {
        $user = $this->getUser();
        if ($user) {
           /* $this is where I should update the cart in the database */
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$productVariantId])){
                $cart[$productVariantId]['quantity'] -= min($quantity, $cart[$productVariantId]['quantity']);
            }
        }
        session()->put('cart',$cart);
    }

    public function removeAll(int $productVariantId) {
        if ($this->getUser()->id) {
           /* $this is where I should update the cart in the database */
        } else {
            $cart = session()->get('cart', []);
            $this->remove($productVariantId, $cart[$productVariantId]['quantity']);
        }
    }

    public function getCart(): array
    {
        if($this->getUser()->id){
            /* $this is where i need to implement getting the cart from the database */
        } else{
            return session()->get('cart', []);
        }
    }


    public function mergeCartOnLogin(User $user)
    {
        $sessionCart = session()->get('cart',[]);
        /* proceed to query for the cart and merge */
    }
}
