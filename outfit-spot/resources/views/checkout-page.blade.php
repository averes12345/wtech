@extends('layouts.basic_layout')

@push('styles')
    <link rel="stylesheet" href="{{asset('css/checkout-page.css')}}">
    <link rel="stylesheet" href="{{asset('css/simple-header.css')}}">
    <link rel="stylesheet" href="{{asset('css/footer.css')}}">
@endpush


@section('title', 'checkout')
@section('favicon')
    {{ asset('img/boost-cart-fill.svg') }}
@endsection
@section('header')
    @include('partials.simple-header')
@endsection
@section('body_class', 'grid')
@section('content')

    <main>
        <div class="review inner-grid">
            <h4 class="bold-text">Review order</h4>

            <!-- <div class="large-img" id="product-img-1"></div> -->
            <!-- <div class="product-body" id="product-body-1"> -->
            <!--     <span class="product-information"> -->
            <!--         <span class="product-name"><b>Nike shoe</b></span> -->
            <!--         <br> -->
            <!--         <span class="product-description">Sleek and lightweight black Nike running shoe designed for -->
            <!--             comfort, speed, and everyday performance. -->
            <!--         </span> -->
            <!--         <br> -->
            <!--         <span class="product-price">165.94€</span> -->
            <!--     </span> -->
            <!--     <div class="controls"> -->
            <!--         <input type="number" value="1" min="0"> -->
            <!--     </div> -->
            <!-- </div> -->
            <!-- <div class="product-remove" id="product-">remove</div> -->
            @foreach ($products as $product)

                <!-- <div class="large-img" id="product-img-1"></div> -->
                <div class="cart-item">
                    <a href="{{ route('product.show', ['currentVariant' => $product['product_variant_id'], 'product' => $product['product_id']]) }}" title="Go to the product page" >
                        <img class="large-img" src="{{ $product['images'][0]}}" alt="Product Image">
                    </a>
                    <div class="product-body" id="product-body-1">
                        <span class="product-information">
                            <span class="product-name"><b>{{$product['product_name']}}</b></span>
                            <br>
                            <span class="product-description">{{$product['product_description']}}</span>
                            <br>
                            <span class="product-price">{{number_format($product['price'] * $product['quantity'], 2)}} €</span>
                        </span>
                        <form action="{{route('cart.update', $product['product_variant_id'])}}" method='POST'class="controls">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" value="{{$product['quantity']}}" min="0">
                        </form>
                    </div>
                    <form action="{{ route('cart.delete', $product['product_variant_id'])}}" method="POST"  class="product-remove" id="product-">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="all: unset;cursor:pointer;" class="product-remove">remove</button>
                    </form>
                </div>
            @endforeach
        </div>
        <div class="inner-grid {{$hideDetails ? 'shipping-option' : 'shipping-details'}}">
            <form method="POST" action="{{route('checkout.shipping.order')}}" id="shipping_and_payment_option" class="display-contents">
                @csrf
            </form>
            @if(!$hideDetails)
                <h4 class="bold-text" style="grid-column: span 2;">Ship to</h4>
                <form method="POST" action="{{route('checkout.shipping.details')}}" id="shipping_details_form" class="display-contents">
                    @csrf
                </form>
                <input form="shipping_details_form" name="first_name" type="text" id="first-name" placeholder="first name" value="{{old('first_name', $user->shippingDetails->first_name ?? $user->first_name ?? '')}}">
                <!-- <p><span style="color: red;">*</span> indicates required fields.</p> -->
                <!-- <label for="first-name">First name</label> -->
                <input form="shipping_details_form" name="last_name" type="text" id="last-name" placeholder="last name" value="{{old('last_name', $user->shippingDetails->$user->last_name  ?? $user->last_name ?? '')}}">
                <input form="shipping_details_form" name="email" type="email" id="email" placeholder="email" value="{{old('email', $user->shippingDetails->email ?? $user->email ?? '')}}">
                <!-- <input form="shipping_details_form" name="phone_number" type="tel" id="phone-number" placeholder="phone number" value="{{old('phone_number', $user->shippingDetails->phone ?? '')}}" pattern="" title="Please enter a valid phone number."> -->
                <label for="country"></label>
                <select form="shipping_details_form" name="country" id="country">
                    <option value="" disabled @selected(old('country', optional($user?->shippingDetails)?->country_id) == '')>
                        Select a country
                    </option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->code}}" @selected(old('country', optional($user?->shippingDetails)?->country_id) == $country->code)>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
               <input form="shipping_details_form" name="street_address" type="text" id="street-address" placeholder="street address" value="{{old('street_address', $user->shippingDetails->street_address ?? '')}}">
                <input form="shipping_details_form" name="city" type="text" id="city" placeholder="city" value="{{old('city', $user->shippingDetails->city ?? '')}}">
                <input form="shipping_details_form" name="region" type="text" id="region" placeholder="region" value="{{old('region', $user->shippingDetails->region ?? '')}}">
                <input form="shipping_details_form" name="zip_code" type="text" id="zip-code" placeholder="zip" value="{{old('zip_code', $user->shippingDetails->zip_code ?? '')}}">
                <button form="shipping_details_form" id="submit" class="continue-button" type="submit">Proceed to Shipping</button>
            @else
                <!-- choose the shipping option here -->
                <h4 class="bold-text">Ship with</h4>
                <form method="POST" action="{{route('checkout.shipping.order')}}" id="shipping_and_payment_option" class="display-contents">
                    @csrf
                </form>
                <input form="shipping_and_payment_option" class="payment box" type="radio" name="shipping_options" value="ups-standard" id="shipping-option-ups-standard" onclick="updateShippingCost(this.value)" required>
                <label for="shipping-option-ups-standard" class="shipping-option-subgrid">
                    <div>
                        <img src="{{asset('img/ups-logo.svg')}}" alt="UPS" class="small-img">
                        <p>Standard</p>
                    </div>
                    <p> {{$shippingPrices['ups-standard']}} € </p>
                    <p> 5-7 business days </p>
                </label>
                <input form="shipping_and_payment_option" class="payment box" type="radio" name="shipping_options" value="ups-expedited" id="shipping-option-ups-worldwide-expedited" onclick="updateShippingCost(this.value)" required>
                <label for="shipping-option-ups-worldwide-expedited" class="shipping-option-subgrid">
                    <div>
                        <img src="{{asset('img/ups-logo.svg')}}" alt="UPS" class="small-img">
                        <p>Expedited</p>
                    </div>
                    <p> {{$shippingPrices['ups-expedited']}} € </p>
                    <p> 3-5 business days </p>
                </label>
                <input form="shipping_and_payment_option" class="payment box" type="radio" name="shipping_options" value="dhl-express" id="shipping-option-dhl-express" onclick="updateShippingCost(this.value)" required>
                <label for="shipping-option-dhl-express"  class="shipping-option-subgrid">
                    <div>
                        <img src="{{asset('img/dhl-logo.svg')}}" alt="dhl express logo" class="large-img">
                    </div>
                    <p> {{$shippingPrices['dhl-express']}} € </p>
                    <p> 1-3 business days </p>
                </label>
<!-- style="all: unset;cursor:pointer;"  -->
<!-- style="grid-column: span 4; width: 30%;" -->
                <form method="POST" action="{{route('checkout.shipping.option')}}" id="shipping_information_reenter" class="display-contents">
                    @csrf
                </form>

                <button form="shipping_information_reenter" style="all: unset;cursor:pointer;grid-column: 4; grid-row: 1;" id="submit" class="continue-button" type="submit" title="reenter the shipping information">
                    <div style="display:grid;justify-items:end; align-items:start;height:100%;">
                        <img src="{{asset('img/return.svg')}}" alt="back arrow" class="tiny-img">
                    <div>
                </button>
            @endif
        </div>
        <div class="inner-grid payment">
            <h4 class="bold-text">Pay with</h4>
            <!-- @if($hideDetails) -->
            <!--     <form method="POST" action="{{route('checkout.shipping.order')}}" id="shipping_and_payment_option" class="display-contents"> -->
            <!--         @csrf -->
            <!--     </form> -->
            <!-- @endif -->
            <input form="shipping_and_payment_option" class="payment box" type="radio" name="payment-method" value="card" id="card" required>
            <label for="card">
                <div class="card">
                    <div class="small-img" id="visa"> </div>
                    <div class="small-img" id="master-card"></div>
                    <div class="small-img" id="american-express"></div>
                </div>
            </label>
            <input form="shipping_and_payment_option" class="payment box" type="radio" name="payment-method" value="google-pay" id="google-pay" required>
            <label for="google-pay">
                <div class="large-img" id="google-pay"></div>
            </label>
            <input form="shipping_and_payment_option" class="payment box" type="radio" name="payment-method" value="apple-pay" id="apple-pay" required>
            <label for="apple-pay">
                <div class="large-img" id="apple-pay"></div>
            </label>
        </div>

    </main>
    <div>
    </div>
    <aside>
        <div class="inner-grid summary">
            <h4 class="bold-text">Summary</h4>
            <!-- Dont even need all the stupid classes it just falls into the correct cells XD -->
            @php
                $productTotal = collect($products)->sum(function ($product) {
                    return $product['price'] * $product['quantity'];
                });
            @endphp
            <span class="items-anotation">Item(s)</span> <span class="value items-value">{{number_format($productTotal, 2) . '€'}}</span>
            <span class="shipping-anotation">Shipping</span><span class="value shipping-value" id="shipping-cost-display">0€</span>
            <!-- Probably not even necessart this is US bullshit  -->
            <span class="vat-anotation">VAT</span><span class="value vat-value" id="vat-display">{{number_format($productTotal * 0.2, 2) . '€'}}</span>
            <hr>
            <span class="total-anotation">Order total</span><span class="value total-value" id="order-total-display">{{number_format($productTotal * 1.2, 2) . '€'}}</span>
            <button form="shipping_and_payment_option" type="submit" class="button continue-button">
                <span class="button-text">Confirm and pay</span>
            </button>
            <div class="errors">
                @error('shipping_details')
                    <div>{{$message}}</div>
                    <br>
                @enderror

                @error('shipping_options')
                    <div>{{ $message }}</div>
                    <br>
                @enderror

                @error('payment-method')
                    <div>{{ $message }}</div>
                    <br>
                @enderror
            <div>
        </div>
    </aside>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quantityInputs = document.querySelectorAll('.controls input[type="number"]');

            quantityInputs.forEach(input => {
                input.addEventListener('change', function () {
                    this.form.submit();
                });
            });
        });
    </script>
    <script>
        const shippingPrices = @json($shippingPrices);

       function updateShippingCost(shippingMethod) {
        const shippingCost = shippingPrices[shippingMethod] || 0;
        const productTotal = parseFloat('{{ $productTotal }}');
        const vatDisplay = document.getElementById('vat-display');
        const orderTotal = document.getElementById('order-total-display');

        document.getElementById('shipping-cost-display').innerText = shippingCost.toFixed(2) + '€' ;

        const vat = 0.2 * (productTotal + shippingCost);

        vatDisplay.innerText = vat.toFixed(2) + '€';
        orderTotal.innerText = (productTotal + shippingCost +  vat).toFixed(2) + '€';
        }
    </script>
    <script>
        window.addEventListener('DOMContentLoaded', function(){
            console.log('Loaded inputs', document.querySelectorAll('input[form="shipping_and_payment_option"]').length);
            document.querySelectorAll('input[form="shipping_and_payment_option"]').forEach(function(input){
                input.addEventListener('change', function(){
                    console.log('Saving', input.name, input.value);
                    localStorage.setItem(input.name, input.value);
                });
            });
            //made to work for input as well, but is probably not necessary
            document.querySelectorAll('input[form="shipping_and_payment_option"]').forEach(function(input){
                const savedValue = localStorage.getItem(input.name);
                if(savedValue){
                    if(input.type === 'radio'){
                        if(input.value === savedValue){
                            console.log('loading', input.name, input.value);
                            input.checked = true;
                        }
                    } else{
                        console.log('what am I doing?', input.name, input.value);
                        input.value = savedValue;
                    }
                }
            });
            const savedShippingOption = localStorage.getItem('shipping_options');
            if(savedShippingOption){
                updateShippingCost(savedShippingOption);
            }
        });
    </script>

    @if(!$hideDetails)
        <script>
            const emailInput = document.getElementById('email');

            emailInput.addEventListener('blur', function() {
                if (!emailInput.checkValidity()) {
                    emailInput.reportValidity();
                }
            });
        </script>
    @endif
  @endsection
