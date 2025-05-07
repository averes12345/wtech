@extends('layouts.basic_layout')

@push('styles')
    <link rel="stylesheet" href="{{asset('css/login-page.css')}}">
    <link rel="stylesheet" href="{{asset('css/simple-header.css')}}">
    <link rel="stylesheet" href="{{asset('css/simple-footer.css')}}">
@endpush

@section('title', 'Log In')
@section('favicon')
    {{ asset('img/logo-white.svg') }}
@endsection
@section('header')
    @include('partials.simple-header')
@endsection
@section('body_class', 'login-container')
@section('content')
        <main class="page-body">
            <h2 class="heading"> Sign in to your account</h2>
            <p> New? <span> <a href="/registration"> Create account </a> </span> </p>
            <form id="login-form" method="POST" action="{{route('login.submit')}}" novalidate>
                @csrf

                <input class="input" type="email" id="login-page_mail" name="email" placeholder="email" required>
                <input class="input" type="password" id="login-page_pass" name="password" placeholder="password" required>
                <input class="button continue-button" type="submit" id="login-page_continue" name="continue"
                    value="Log in">
            </form>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="horizontal-or-divider">
                <span class="floating-or"> or </span>
            </div>
            <button href="../src/login-with-google-page.html" class="button">
                <div class="spacer">
                    <!-- Need to convert to a different element to reflect semantics -->
                    <img src="../img/google-logo.svg" alt="Google logo">
                </div>
                <span class="button-text">Log in with Google</span>
                <div class="spacer"></div>
            </button>
        </main>
        @section('footer')
            @include('partials.simple-footer')
        @endsection
@endsection
