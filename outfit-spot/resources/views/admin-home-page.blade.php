@extends('layouts.basic_layout')

@push('styles')
    <link rel="stylesheet" href="{{asset('css/admin-category-page.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    <link rel="stylesheet" href="{{asset('css/footer.css')}}">
@endpush

@section('title', 'Admin Home')
@section('favicon', '../img/logo-white.svg')
@section('body_class', 'grid')
@section('content')
    <aside>
        <form id="filter" class="inner-grid">
            <div>Brand</div>
            @foreach($brands as $brand)
                <span>
                    <input type="checkbox" name="brands[]" value="{{$brand->id}}" id="brand-{{$brand->id}}">
                    <!-- @checked(in_array($brand->id, request('brands', []))) -->
                    <label for="brand-{{ $brand->id }}">
                        {{ $brand->name }}
                    </label>
                </span>
            @endforeach
            <hr>

            <div>Color</div>
            @foreach($colors as $color)
                <span>
                    <input type="checkbox" name="colors[]" value="{{$color->id}}" id="color-{{$color->id}}">
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

            <div>Price</div>
            <div>
                <input type="range">
            </div>
            <button type="submit">Filter</button>
            <a href="{{ route('addProduct') }}" class="button-wrapper">
                <button type="button">Add an item</button>
            </a>
        </form>

    </aside>
    <script>
        document.querySelector("#filter").addEventListener("submit", function (e) {
            e.preventDefault();
        });
    </script>

    <main>
        <div class="inner-grid products">
            <div class="item">
                <div class="img-wrapper">
                    <img src="../img/unsplash_licence-640x640-nike-shoe-black.jpg" alt="" class="card-img">
                </div>
                <div class="description-wrapper">
                    <div class="description">
                        This is a great product
                    </div>
                    <button class="edit">
                        <a href="../src/admin-edit-product.html">
                            <img src="../img/svg_repo-edit.svg" alt="" class="tiny-img">
                        </a>
                    </button>
                    <button class="remove">
                        <img src="../img/svg_repo-remove.svg" alt="" class="tiny-img">
                    </button>
                </div>
            </div>
            @foreach($products as $pcs)
                <div class="item">
                    <div class="img-wrapper">
                        <img src="{{asset($pcs->mainImage->image_path)}}" alt="{{$pcs->mainImage->alt}}" class="card-img">
                    </div>
                    <div class="description-wrapper">
                        <div class="description">
                           <h5> {{"{$pcs->product->brand->name} {$pcs->product->name}"}} </h5>
                           <p> {{number_format($pcs->product->price,2)}} €</p>
                        </div>
                        <button class="edit">
                            <a href="../src/admin-edit-product.html">
                                <img src="../img/svg_repo-edit.svg" alt="" class="tiny-img">
                            </a>
                        </button>
                        <button class="remove">
                            <img src="../img/svg_repo-remove.svg" alt="" class="tiny-img">
                        </button>
                    </div>
                </div>
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
@endsection

