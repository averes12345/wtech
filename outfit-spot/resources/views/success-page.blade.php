
@extends('layouts.basic_layout')

@push('styles')
    <link rel="stylesheet" href="{{asset('css/checkout-page.css')}}">
    <link rel="stylesheet" href="{{asset('css/simple-header.css')}}">
    <link rel="stylesheet" href="{{asset('css/footer.css')}}">
@endpush


@section('title', 'order-succesfull')
@section('favicon')
    {{ asset('img/logo-black-white_background.svg') }}
@endsection
@section('header')
    @include('partials.simple-header')
@endsection
@section('body_class', 'grid')
@section('content')
    <main>
        <p> This is the success page </p>
    </main>
    <script>
        @if (!empty($clearLocalStorage) && $clearLocalStorage)
            console.log('Clearing local storage as requested by backend');
            localStorage.clear();
        @endif
    </script>
 @endsection
