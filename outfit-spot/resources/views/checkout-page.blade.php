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
        <div class="inner-grid review">
            <h4 class="bold-text">Review order</h4>
            <div class="large-img" id="product-img-1"></div>
            <div class="product-body" id="product-body-1">
                <span class="product-information">
                    <span class="product-name"><b>Nike shoe</b></span>
                    <br>
                    <span class="product-description">Sleek and lightweight black Nike running shoe designed for
                        comfort, speed, and everyday performance.
                    </span>
                    <br>
                    <span class="product-price">165.94€</span>
                </span>
                <div class="controls">
                    <input type="number" value="1" min="0">
                </div>
            </div>
            <div class="product-remove" id="product-">remove</div>
        </div>
        <div class="inner-grid shipping">
            <h4 class="bold-text">Ship to</h4>
            <label for="country"></label>
            <select id="country">
                <option value="" disabled selected>Select a country</option>
                <option value="sk">Slovakia</option>
                <option value="cz">Czech Republic</option>
                <option value="us">United States</option>
                <option value="de">Germany</option>
            </select>
            <input type="text" id="first-name" placeholder="first name">
            <input type="text" id="last-name" placeholder="last name">
            <input type="text" id="street-address" placeholder="street address">
            <input type="text" id="city" placeholder="city">
            <input type="text" id="region" placeholder="region">
            <input type="text" id="zip-code" placeholder="zip">
            <input type="email" id="email" placeholder="email">
            <input type="tel" id="phone-number" placeholder="phone number">
            <button id="submit" class="continue-button">Done
            </button>
        </div>
        <div class="inner-grid payment">
            <h4 class="bold-text">Pay with</h4>
            <input class="payment box" type="radio" name="payment-method" value="card" id="card">
            <label for="card">
                <div class="card">
                    <div class="small-img" id="visa"> </div>
                    <div class="small-img" id="master-card"></div>
                    <div class="small-img" id="american-express"></div>
                </div>
            </label>
            <input class="payment box" type="radio" name="payment-method" value="google-pay" id="google-pay">
            <label for="google-pay">
                <div class="large-img" id="google-pay"></div>
            </label>
            <input class="payment box" type="radio" name="payment-method" value="apple-pay" id="apple-pay">
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
            <span class="items-anotation">Item(s)</span> <span class="value items-value">165.94€</span>
            <span class="shipping-anotation">Shipping</span><span class="value shipping-value">14€</span>
            <!-- Probably not even necessart this is US bullshit  -->
            <span class="vat-anotation">VAT</span><span class="value vat-value">9€</span>
            <hr>
            <span class="total-anotation">Order total</span><span class="value total-value">188.94</span>
            <button href="../src/temp.html" class="button continue-button">
                <span class="button-text">Confirm and pay</span>
            </button>
        </div>
    </aside>
  @endsection
