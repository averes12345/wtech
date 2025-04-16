<?php

namespace App;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartService
{
    protected $userId;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->userId = Auth::id();
        //
    }

    public function add(int $productId, int $quantity = 1): void /* quantity has to be unsigned */
    {
        $product = Product::findOrFail($productId);

        if($this->userId){
           /* this is where I should update the cart in the database */
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])){
                $cart[$productId]['quantity'] += $quantity;
            } else {
                $cart[$productId] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                ];
            }

            session()->put('cart',$cart);
        }
    }

    public function remove(int $productId, int $quantity) :void /* quantity has to be unsigned */
    {
        if ($this->userId) {
           /* this is where I should update the cart in the database */
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$productId])){
                $cart[$productId]['quantity'] -= min($quantity, $cart[$productId]['quantity']);
            }
        }
        session()->put('cart',$cart);
    }

    public function getCart(): array
    {
        if($this->userId){
            /* this is where i need to implement getting the cart from the database */
        } else{
            return session()->get('cart', []);
        }
    }


    public function mergeCartOnLogin(User $user)
    {
    $sessionCart = session()->get('cart',[]);

    }
}
