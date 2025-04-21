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


@section('title', 'Products')

@section('favicon')
    {{ asset('img/logo-white.svg') }}
@endsection

@section('header')
    @include('partials.user-header')
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <aside class="col-lg-3 mb-4 filter-sidebar">
                <form action="{{ route('products.byCategory', ['category' => $category->name]) }}" method="GET">
                    <div class="mb-3">
                        <h5>Značky</h5>
                        <div class="overflow-auto" style="max-height: 80px">
                            @foreach($brands as $brand)
                                <div class="form-check" style="margin-left: 10px">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="brands[]"
                                        value="{{ $brand->id }}"
                                        id="brand-{{ $brand->id }}"
                                        @checked(in_array($brand->id, request('brands', [])))
                                    >
                                    <label class="form-check-label" for="brand-{{ $brand->id }}">
                                        {{ $brand->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-3">
                        <h5>Farba</h5>
                        <div class="overflow-auto" style="max-height: 80px">
                            @foreach($colors as $color)
                                <div class="form-check d-flex align-items-center" style="margin-left: 10px">
                                    <input
                                        class="form-check-input me-2"
                                        name="colors[]"
                                        value="{{ $color->id }}"
                                        id="color-{{ $color->id }}"
                                        type="checkbox"
                                        @checked(in_array($color->id, request('colors', [])))
                                    >
                                    <span class="color-sample" style="background-color: {{ $color->hex }};"></span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <h5>Cena</h5>
                        <div>
                            <p>Od</p>
                            <label for="minPriceRange"></label><input type="range" class="form-range" min="0" max="1000"
                                                                      id="minPriceRange">
                            <label for="minPrice"></label><input type="text" class="form-control" placeholder="min" id="minPrice">
                        </div>
                        <div class="mt-2">
                            <p>Do</p>
                            <label for="maxPriceRange"></label><input type="range" class="form-range" min="0" max="1000"
                                                                      id="maxPriceRange">
                            <label for="maxPrice"></label><input type="text" class="form-control" placeholder="max" id="maxPrice">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button class="btn btn-primary" type="submit">Filtrovať</button>
                    </div>
                </form>
            </aside>

            <main class="col-md-9">
                @switch($category->name)
                    @case('hoodies')
                        <h2>Mikiny</h2>
                        @break

                    @case('shirts')
                        <h2>Tričká</h2>
                        @break

                    @case('pants')
                        <h2>Nohavice</h2>
                        @break

                    @case('shoes')
                        <h2>Topánky</h2>
                        @break
                @endswitch

                <div class="filters-active mb-3">
                    <span>Filter 1 ✕</span>
                    <span>Filter 2 ✕</span>
                    <span>Filter 3 ✕</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    @php
                        $totalProducts = $products->sum(fn($product) => $product->uniqueVariants->count());
                    @endphp
                    <span>{{ $totalProducts }} produktov</span>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            Zoradiť podľa
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                            <li><a class="dropdown-item" href="#">Abecedy ↑</a></li>
                            <li><a class="dropdown-item" href="#">Abecedy ↓</a></li>
                            <li><a class="dropdown-item" href="#">Ceny ↑</a></li>
                            <li><a class="dropdown-item" href="#">Ceny ↓</a></li>
                        </ul>
                    </div>

                </div>
                <div class="product-grid">
                    @foreach($products as $product)
                        @foreach($product->uniqueVariants as $variant)
                            <div class="card product">
                                <img class="img-fluid product-img" alt="{{ $variant->mainImage->alt }}" title="AI Generated Image" src="{{ $variant->mainImage->image_path }}">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->price }}€</p>
                                </div>
                                <a href="/product" class="stretched-link"></a>
                            </div>
                        @endforeach
                    @endforeach
                </div>

                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled"><a class="page-link">⬅️</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">➡️</a></li>
                    </ul>
                </nav>
            </main>
        </div>
    </div>
@endsection

