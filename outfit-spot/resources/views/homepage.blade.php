@extends('layouts.basic_layout')

@push('styles')
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
    />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
@endpush

@section('title', 'OutfitSpot')

@section('favicon')
    {{ asset('img/logo-white.svg') }}
@endsection

@section('header')
    @include('partials.user-header')
@endsection

@section('content')
    <div class="content homepage-hero">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <h1>Dress to Impress<br>Every Single Day</h1>
                    <p>Your style is a reflection of your attitude and personality.<br> Own it, wear it, live it.</p>
                </div>
                <div class="col-2">
                    <img src="{{asset('/img/Home.jpg')}}" alt="Homepage Photo" title="https://www.nike.com/sk/basketball/lebron-james">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid my-5">
        <h2 class="mb-4">Kategórie</h2>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img
                        src="{{asset('/img/tshirt-card.png')}}"
                        class="card-img-top"
                        alt="Tričká"
                        title="AI Generated Image"
                    />
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Tričká</h5>
                        <i class="bi bi-arrow-right fs-4"></i>
                    </div>
                    <a href="tvoja-cielova-stranka.html" class="stretched-link"></a>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img
                        src="{{asset('/img/hoodies-card.png')}}"
                        class="card-img-top"
                        alt="Mikiny"
                        title="AI Generated Image"
                    />
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Mikiny</h5>
                        <i class="bi bi-arrow-right fs-4"></i>
                    </div>
                    <a href="categoryPage.html" class="stretched-link"></a>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img
                        src="{{asset('/img/pants-card.png')}}"
                        class="card-img-top"
                        alt="Nohavice"
                    />
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Nohavice</h5>
                        <i class="bi bi-arrow-right fs-4"></i>
                    </div>
                    <a href="tvoja-cielova-stranka.html" class="stretched-link"></a>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img
                        src="{{asset('/img/shoes-card.png')}}"
                        class="card-img-top"
                        alt="Topánky"
                    />
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Topánky</h5>
                        <i class="bi bi-arrow-right fs-4"></i>
                    </div>
                    <a href="tvoja-cielova-stranka.html" class="stretched-link"></a>
                </div>
            </div>
        </div>
    </div>
@endsection
