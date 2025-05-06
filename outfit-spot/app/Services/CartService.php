<?php

namespace App\Services;

use App\Models\ProductColorSize;
use App\Models\ShippingDetails;
use App\Models\User;
use App\Models\Product;
use App\Models\Orders;
use App\Models\OrderItems;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
        $productVariant = ProductColorSize::find($productVariantId); // should make sure an incorrect id gets here
        if($productVariant->count_in_stock <= 0){
            return;
        }
        $user = $this->getUser();
        /* $quantity = min($quantity, $productVariant->count_in_stock); // make sure you dont add more that can be in stock */

        if($user){ // user is logged in
           if(!$user->cart_id){ // user does not have a cart yet
                $orders = Orders::create(['user_id' => $user->id]);
                $user->cart_id = $orders->id;
                $user->save();
           }
           $order_item = OrderItems::where('orders_id', $user->cart_id)->where('specific_product_id', $productVariantId)->first();
           if($order_item){ // user has the item we want to add in the cart
                $order_item->quantity = min($quantity + $order_item->quantity, $productVariant->count_in_stock);
                $order_item->save();
           }else{ // user does not have the item we want to add in the cart
               OrderItems::create(['orders_id' => $user->cart_id, 'specific_product_id' => $productVariantId, 'quantity' => min($quantity,  $productVariant->count_in_stock)]);
           }
        } else { // user is not logged in
            $cart = session()->get('cart', []);

            if (isset($cart[$productVariantId ])){ // user has the item we want to add in the cart
                $cart[$productVariantId ]['quantity'] = min($quantity + $cart[$productVariantId]['quantity'], $productVariant->count_in_stock);
            } else { // user does not have the item we want to add in the cart
                $cart[$productVariantId] = [
                    'quantity' => min($quantity, $productVariant->count_in_stock),
                ];
            }

            session()->put('cart',$cart);
        }
    }

    public function remove(int $productVariantId, int $quantity = 1) :void /* quantity has to be unsigned */
    {
        $user = $this->getUser();
        if ($user) {
            $item = $user->cart->items->firstWhere('specific_product_id', $productVariantId);
            if($item){
                $item->quantity -= min($quantity, $item->quantity);
                $item->save();
            }
           /* $this is where I should update the cart in the database */
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$productVariantId])){
                $cart[$productVariantId]['quantity'] -= min($quantity, $cart[$productVariantId]['quantity']);
                session()->put('cart',$cart);
            }
        }
    }

    public function delete(int $productVariantId) {
        $user = $this->getUser();
        if ($user) {
            $item = $user->cart->items->firstWhere('specific_product_id', $productVariantId);
            $item_count = count($user->cart->items);
            if($item){
                $item->delete();
                $item_count -= 1;
            }
            if($item_count == 0){
                $user->cart_id = null;
                $user->save();
                $user->cart->delete();
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$productVariantId])){
                unset($cart["$productVariantId"]);
                session()->put('cart',$cart);
            }
        }
    }

    public function getItemQuantity(int $productVariantId){
        $user = $this->getUser();
        if($user){
           return OrderItems::where('orders_id', $user->cart_id)->where('specific_product_id', $productVariantId)->first()->quantity ?? 0;
        }
        if(!session()->get('cart', []) || !array_key_exists($productVariantId, session()->get('cart'))){
            return 0;
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
            /* dd($cartItems[0]->specificProduct); */
            /* dd($cartItems, $cartItems->find(13)->specificProduct, $cartItems->find(13)->specificProduct->id); */
           return $cartItems->map(function ($item) {
           return [
               'product_id'        => $item->specificProduct->product->id,
               'product_variant_id' => $item->specific_product_id,
               'quantity' => $item->quantity,
               'color' => $item->specificProduct->color->name ?? null,
               'size' => $item->specificProduct->size->size ?? null,
               'product_name' => $item->specificProduct->product->name ?? null,
               'product_description' => $item->product->description ?? null,
               'images' => $item?->specificProduct?->images?->pluck('image_path')->toArray() ?? [],
               'price' => $item?->product?->price,
               'stock' => $item?->count_in_stock,
            ];
        })->sortBy([['product_name', 'asc'], ['product_variant_id', 'asc']])->toArray();
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
                'product_id'        => $variant->product->id,
                'product_variant_id' => $variantId,
                'quantity' => $item['quantity'],
                'color' => $variant?->color?->name,
                'size' => $variant?->size?->size,
                'product_name' => $variant?->product?->name,
                'product_description' => $variant->product->description ?? null,
                'images' => $variant?->images?->pluck('image_path')->toArray() ?? [],
                'price' => $variant?->product?->price,
                'stock' => $variant?->count_in_stock,
            ];})->sortBy('product_name')->values()->toArray();

            return $mappedCart;
        }
    }
    public function productCount(){
        $user = $this->getUser();
        if($user){ // user is logged in
           if (!$user->cart_id){ // user has no cart
                return 0;
           }
           $cartItems = $user->cart->items;
        }else{
            $cartItems = session->get('cart');
        }
        return count($cartItems);
    }

    public function buy(){
        return DB::transaction(function () {
            $user = $this->getUser();
            if($user){
                if(!$user->cart_id){
                        /* need to name this apropriatly */
                        throw new \Exception('User does not have a cart', 1);
                }
               $cartItems = $user->cart->items;
               $products = ProductColorSize::whereIn('id', $cartItems->pluck('specific_product_id')->toArray())->get();
               /* dump($cartItems, $products); */
               foreach($products as $product){
                    /* dd($cartItems->firstWhere('specific_product_id', $product->id)); */
                   $cartItem= $cartItems->firstWhere('specific_product_id', $product->id);
                   /* dd($cartItemQuantity); */
                    if (!$cartItem) {
                        throw new \Exception("Cart item for specific_product_id {$product->id} not found", 3);
                    }
                   $cartItemQuantity = $cartItem->quantity;
                    if($product->count_in_stock >= $cartItemQuantity){
                        $product->count_in_stock -= $cartItemQuantity;
                    }else { //something went wrong cancel the order and return false
                        /* need to name this apropriatly */
                        throw new \Exception('Count in cart > count in stock', 2);
                    }
                }
                /* dump(['user->cart_id' => $user->cart_id]); */
                $order = Orders::find($user->cart_id);
                $userShippingDetails = ShippingDetails::find($user->saved_shipping_preference);
                $orderShippingDetails = $userShippingDetails->replicate();
                $orderShippingDetails->save();
                /* dump([ */
                /*     'order' => $order, */
                /*     'order_class' => get_class($order), */
                /*     'orderShippingDetails' => $orderShippingDetails, */
                /*     'orderShippingDetailsId' => $orderShippingDetails->id, */
                /* ]); */
                $order->shipping_details_id = $orderShippingDetails->id;
                $order->save();
                $user->cart_id = null;
                $user->save();
                $products->each->save();
            } else {
                $cart = session()->get('cart');
                if(!$cart || sizeof($cart) == 0){
                    throw new \Exception('User does not have a cart', 1);
                }
                $order = session->get('shippingDetails');
                $products = ProductColorSize::whereIn('id', array_keys($cart))->get();
                foreach($products as  $product){
                    if($product->count_in_stock >= $cart[$product->id]){
                        $product->count_in_stock -= $cart[$product->id];
                    }
                    else{
                        /* need to name this apropriatly */
                        throw new \Exception('Count in cart > count in stock', 2);
                    }
                }
                $orderShippingDetails = ShippingDetails::create([
                    'first_name' => $order['first_name'],
                    'last_name' => $order['last_name'],
                    'email' => $order['email'],
                    'phone' => $order['phone_number'],
                    'country_id' => $order['country'],
                    'street_address' => $order['street_address'],
                    'city' => $order['city'],
                    'region' => $order['region'],
                    'zip_code' => $order['zip_code'],
                    ]);
                $orderShippingDetails->save();
                $order = Orders::create([
                'user_id' => null,
                'shipping_details_id' => $orderShippingDetails->id,
                ]);

                foreach ($cart as $productVariantId => $item){
                   OrderItems::create([
                       'orders_id' => $orderShippingDetails->id,
                       'specific_product_id' => $productVariantId,
                       'quantity' => $item['quantity'],
                   ]);
                }
                $products->each->save();
            }
            return $orderShippingDetails;
        });
    }


    public function mergeSessionAfterLogin(User $user)
    {
        $sessionCart = session()->get('cart',[]);

        if(empty($sessionCart)){
            return;
        }

        if(!$user->cart_id){
            $order = Orders::create(['user_id' => $user->id]);
            $user->cart_id = $order->id;
            $user->save();
        }

        foreach ($sessionCart as $productVariantId => $item){
           $existingItem = OrderItems::where('orders_id', $user->cart_id)
           ->where('specific_product_id', $productVariantId)
           ->first();

           if ($existingItem) { // if item already exists in DB cart, increase quantity
                $existingItem->quantity += $item['quantity'];
                $existingItem->save();
           } else { // else, create new cart item
               OrderItems::create([
                   'orders_id' => $user->cart_id,
                   'specific_product_id' => $productVariantId,
                   'quantity' => $item['quantity'],
               ]);
           }
        }
        session()->forget('cart');
    }
}
