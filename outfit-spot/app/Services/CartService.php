<?php

namespace App\Services;

use App\Models\ProductColorSize;
use App\Models\User;
use App\Models\Product;
use App\Models\Orders;
use App\Models\OrderItems;

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
        /* dd($productVariantId, $quantity); */
        $user = $this->getUser();
        if($user){ // user is logged in
           if(!$user->cart_id){ // user does not have a cart yet
                $orders = Orders::create(['user_id' => $user->id]);
                $user->cart_id = $orders->id;
                $user->save();
           }
           $order_item = OrderItems::where('orders_id', $user->cart_id)->where('specific_product_id', $productVariantId)->first();
           /* dd($order_item); */
           if($order_item){ // user has the item we want to add in the cart
                $order_item->quantity += $quantity;
                $order_item->save();
           }else{ // user does not have the item we want to add in the cart
               OrderItems::create(['orders_id' => $user->cart_id, 'specific_product_id' => $productVariantId, 'quantity' => $quantity]);
           }
        } else { // user is not logged in
            $cart = session()->get('cart', []);

            if (isset($cart[$productVariantId ])){ // user has the item we want to add in the cart
                $cart[$productVariantId ]['quantity'] += $quantity;
            } else { // user does not have the item we want to add in the cart
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

    public function delete(int $productVariantId) {
        $user = $this->getUser();
        if ($user) {
           /* $this is where I should update the cart in the database */
        } else {
            $cart = session()->get('cart', []);
            unset($cart["$productVariantId"]);
            /* dd($cart); */
        }
        session()->put('cart',$cart);
    }

    public function getItemQuantity(int $productVariantId){
        $user = $this->getUser();
        if($user){
           return OrderItems::where('orders_id', $user->cart_id)->where('specific_product_id', $productVariantId)->first()->quantity;
        }
        return session()->get('cart', [])[$productVariantId]['quantity'];
    }

    public function getCart(): array
    {
        $user = $this->getUser();
        if($user){ // user is logged in
           if (!$user->cart_id){ // user has no cart
                return [];
           }
           $cartItems = $user->cart->items;
           return $cartItems->map(function ($item) {
           return [
               'product_variant_id' => $item->specific_product_id,
               'quantity' => $item->quantity,
               'color' => $item->specificProduct->color->name ?? null,
               'size' => $item->specificProduct->size->size ?? null,
               'product_name' => $item->specificProduct->product->name ?? null,
               'images' => $item?->images?->pluck('image_path')->toArray() ?? [],
               'price' => $item?->product?->price,
               'stock' => $item?->count_in_stock,
            ];
        })->toArray();
        } else{

            $cart = session()->get('cart', []);
            $productVariantIds = array_keys($cart);
            /* dd($cart, $productVariantIds); */
            $productVariants = ProductColorSize::with([
                'product',
                'color',
                'size',
                'images',
            ])->whereIn('id', $productVariantIds)->get()->keyBy('id');
            $mappedCart = collect($cart)->map(function ($item, $variantId) use ($productVariants) {
            $variant = $productVariants[$variantId] ?? null;

            return [
                'product_variant_id' => $variantId,
                'quantity' => $item['quantity'],
                'color' => $variant?->color?->name,
                'size' => $variant?->size?->size,
                'product_name' => $variant?->product?->name,
                'images' => $variant?->images?->pluck('image_path')->toArray() ?? [],
                'price' => $variant?->product?->price,
                'stock' => $variant?->count_in_stock,
            ];})->values()->toArray();
            return $mappedCart;
        }
    }


    public function mergeCartOnLogin(User $user)
    {
        $sessionCart = session()->get('cart',[]);
    }
}
