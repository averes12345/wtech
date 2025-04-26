@extends('layouts.basic_layout')

@push('styles')
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
    />

    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.css"
        rel="stylesheet"
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
    <div class="container-fluid mt-4" style="height: 100%;">
        <div class="row">
            <aside class="col-lg-3 mb-4 filter-sidebar">
                <form action="{{ route('products.byCategory', ['category' => $category->name]) }}" method="GET">
                    @if(request()->filled('type'))
                        <input type="hidden" name="type" value="{{ request('type') }}">
                    @endif
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
                                    <label for="color-{{ $color->id }}">
                                        <span class="color-sample" style="background-color: {{ $color->hex }};"></span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <h5>Cena</h5>
                        <div id="price-slider" class="mb-3"></div>

                        <div class="d-flex justify-content-between">
                            <input
                                type="number"
                                name="min_price"
                                id="minPrice"
                                class="form-control me-2"
                                placeholder="Min"
                                value="{{ request('min_price', '') }}"
                            >
                            <input
                                type="number"
                                name="max_price"
                                id="maxPrice"
                                class="form-control ms-2"
                                placeholder="Max"
                                value="{{ request('max_price', '') }}"
                            >
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

                <div class="d-flex justify-content-between mb-2">
                    <span>{{ $products->total() }} produktov</span>
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
                        <div class="card product">
                            @if($product->mainImage)
                                <img
                                    class="img-fluid product-img"
                                    src="{{ asset($product->mainImage->image_path) }}"
                                    alt="{{ $product->mainImage->alt }}"
                                >
                            @endif

                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ number_format($product->price,2) }} €</p>
                            </div>

                                <a href="{{ route('product.show', [ 'product'=>$product->id, 'currentVariant'=>$product->variant->id ]) }}" class="stretched-link"></a>
                        </div>
                    @endforeach
                </div>

                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item @if($products->onFirstPage()) disabled @endif">
                            <a class="page-link"
                               href="{{ $products->previousPageUrl() }}"
                               aria-label="Previous">
                                ⬅️
                            </a>
                        </li>

                        @for($i = 1; $i <= $products->lastPage(); $i++)
                            <li class="page-item @if($i == $products->currentPage()) active @endif">
                                <a class="page-link" href="{{ $products->url($i) }}">
                                    {{ $i }}
                                </a>
                            </li>
                        @endfor

                        <li class="page-item @if(!$products->hasMorePages()) disabled @endif">
                            <a class="page-link"
                               href="{{ $products->nextPageUrl() }}"
                               aria-label="Next">
                                ➡️
                            </a>
                        </li>
                    </ul>
                </nav>
            </main>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var slider = document.getElementById('price-slider');
                noUiSlider.create(slider, {
                    start: [
                        {{ request('min_price', 0) }},
                        {{ request('max_price', 400) }}
                    ],
                    connect: true,
                    range: { 'min': 0, 'max': 400 },
                    step: 1,
                    tooltips: false,
                    format: {
                        to: function (value) { return Math.round(value); },
                        from: function (value) { return Number(value); }
                    }
                });

                var inputMin = document.getElementById('minPrice');
                var inputMax = document.getElementById('maxPrice');

                slider.noUiSlider.on('update', function(values, handle) {
                    if (handle === 0) {
                        inputMin.value = values[0];
                    } else {
                        inputMax.value = values[1];
                    }
                });

                inputMin.addEventListener('change', function() {
                    slider.noUiSlider.set([this.value, null]);
                });
                inputMax.addEventListener('change', function() {
                    slider.noUiSlider.set([null, this.value]);
                });
            });
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.js"></script>
    @endpush
@endsection

