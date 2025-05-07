@extends('layouts.basic_layout')

@push('styles')
    <link rel="stylesheet" href="{{asset('css/admin-category-page.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    <link rel="stylesheet" href="{{asset('css/footer.css')}}">
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.css"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush

@section('title', 'Admin Home')
@section('favicon', asset('img/logo-white.svg'))
@section('body_class', 'grid')
@section('content')
    <aside>
        <form name="search-filter" action="{{route('products.find')}}" method="GET" id="filter" class="inner-grid">
            @csrf
            <h5>Brand</h5>
            @foreach($brands as $brand)
                <span>
                    <input type="checkbox" name="brands[]" value="{{$brand->id}}" id="brand-{{$brand->id}}"
                    @checked(in_array($brand->id, request('brands', [])))
                    >
                    <label for="brand-{{ $brand->id }}">
                        {{ $brand->name }}
                    </label>
                </span>
            @endforeach
            <hr>

            <h5>Color</h5>
            @foreach($colors as $color)
                <span>
                    <input type="checkbox" name="colors[]" value="{{$color->id}}" id="color-{{$color->id}}"
                    @checked(in_array($color->id, request('colors', [])))
                    >
                    <!-- @checked(in_array($color->id, request('colors', []))) -->
                    <label for="color-{{$color->id}}">
                        <span style="display:flex; align-items:center;">
                            {{$color->name}}
                            <span class="color-sample" style="background-color: {{$color->hex}};"></span>
                        </span>
                    </label>
                </span>
            @endforeach
            <hr>

            <h5>Price</h5>
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
            <hr>
            <button type="submit">Filter</button>
            <a href="{{ route('addProduct') }}" class="button-wrapper">
                <button type="button">Add an item</button>
            </a>
        </form>

    </aside>
    <!-- <script> -->
    <!--     document.querySelector("#filter").addEventListener("submit", function (e) { -->
    <!--         e.preventDefault(); -->
    <!--     }); -->
    <!-- </script> -->

    <main>
        <div class="inner-grid products">
            <!-- <div class="item"> -->
            <!--     <div class="img-wrapper"> -->
            <!--         <img src="../img/unsplash_licence-640x640-nike-shoe-black.jpg" alt="" class="card-img"> -->
            <!--     </div> -->
            <!--     <div class="description-wrapper"> -->
            <!--         <div class="description"> -->
            <!--             This is a great product -->
            <!--         </div> -->
            <!--         <button class="edit"> -->
            <!--             <a href="../src/admin-edit-product.html"> -->
            <!--                 <img src="../img/svg_repo-edit.svg" alt="" class="tiny-img"> -->
            <!--             </a> -->
            <!--         </button> -->
            <!--         <button class="remove"> -->
            <!--             <img src="../img/svg_repo-remove.svg" alt="" class="tiny-img"> -->
            <!--         </button> -->
            <!--     </div> -->
            <!-- </div> -->
            @foreach($products as $pcs)
                <div class="item">
                    <div class="img-wrapper">
                        <a href="{{route('product.show', ['product' => $pcs->products_id, 'currentVariant' => $pcs->id])}}" title="Go to the product page.">
                            <img src="{{asset($pcs->mainImage->image_path)}}" alt="{{$pcs->mainImage->alt}}" class="card-img">
                        </a>
                    </div>
                    <div class="description-wrapper">
                        <div class="description">
                           <h5> {{$pcs->product->name}} </h5>

                           <p>{{$pcs->product->brand->name}} <br> {{number_format($pcs->product->price,2)}} €</p>
                        </div>
                        <!-- <form action="{{route('products.find')}}" method="POST" id="filter" class="inner-grid"> -->
                        <!--     @csrf -->
                        <button class="edit">
                            <a href="{{route('admin.products.edit', [$pcs->product->id, $pcs->id])}}">
                                <img src="{{asset('img/svg_repo-edit.svg')}}" alt="" class="tiny-img">
                            </a>
                        </button>
                        <!-- </form> -->
                        <form  action="{{route('product.delete', $pcs->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove">
                                <img src="{{asset('img/svg_repo-remove.svg')}}" alt="" class="tiny-img">
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

        </div>
        <!-- <nav class="mt-4"> -->
        <!--     <ul class="pagination justify-content-center"> -->
        <!--         <li class="page-item disabled"><a class="page-link">⬅️</a></li> -->
        <!--         <li class="page-item active"><a class="page-link" href="#">1</a></li> -->
        <!--         <li class="page-item"><a class="page-link" href="#">2</a></li> -->
        <!--         <li class="page-item"><a class="page-link" href="#">3</a></li> -->
        <!--         <li class="page-item"><a class="page-link" href="#">➡️</a></li> -->
        <!--     </ul> -->
        <!-- </nav> -->
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
@endsection

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
        <script>
            document.getElementById('search-submit').addEventListener('click', function (e) {
                const form = document.getElementById('filter');

                form.querySelectorAll('input[name^="brands"], input[name^="colors"], input[name="min_price"], input[name="max_price"]')
                    .forEach(input => input.remove());
            });
        </script>
@endpush

