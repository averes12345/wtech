@extends('layouts.basic_layout')

@push('styles')
    <link rel="stylesheet" href="{{asset('css/registration.css')}}">
    <link rel="stylesheet" href="{{asset('css/simple-header.css')}}">
    <link rel="stylesheet" href="{{asset('css/simple-footer.css')}}">
@endpush


@section('title', 'registration')
@section('favicon')
    {{ asset('img/logo-white.svg') }}
@endsection
@section('header')
    @include('partials.simple-header')
@endsection
@section('footer')
    @include('partials.simple-footer')
@endsection

@section('body_class', 'grid')

@section('content')
<main>
    <!-- Might want to include the bigger version of the image for 2k+ -->
    <img id="registration-page-img" src="../img/registration-page-640x960.jpg">
    <form class="registration-form" id="f-this" method ="POST" action="{{route('login.submit')}}">
            @csrf

            <h2 id="heading" style="text-align: center;">Register</h2>
            <input type="text" id="first-name" placeholder="first name">
            <input type="text" id="last-name" placeholder="second name">
            <input type="email" id="email" placeholder="email">
            <input type="password" id="password" placeholder="password">
            <button type="submit" class="button blue-button">Register</button>


            <!-- horizontal or divider trick only works for block elements so wrapping it inside a container is necessary -->
            <div style="grid-column: span 2;">
                    <div class="horizontal-or-divider">
                            <span>or</span>
                    </div>
            </div>

            <button class="button minimal-button">
                    <!-- Need to convert to a different element to reflect semantics -->
                    <img src="../img/google-logo.svg" alt="Google logo">
                    <span class="button-text">Register with Google</span>
            </button>

    </form>
</main>
@endsection
