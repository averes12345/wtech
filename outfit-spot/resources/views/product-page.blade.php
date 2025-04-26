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
    <link rel="stylesheet" href="{{asset('css/style.css')}}"/>
@endpush


@section('title', 'Product')


@section('favicon')
    {{ asset('img/logo-white.svg') }}
@endsection

@section('header')
    @include('partials.user-header')
@endsection

@section('content')
    @php
        $productType = [
            'male' => 'Muži',
            'female' => 'Ženy',
            'kids' => 'Deti'
        ];
        $productCategory = [
            'shirts' => 'Tričká',
            'hoodies' => 'Mikiny',
            'pants' => 'Nohavice',
            'shoes' => 'Topánky'
        ];

        $typeLabel = $productType[$product->type] ?? null;
        $categoryLabel = $productCategory[$category->name] ?? null;
    @endphp
    <main>
        <div class="container">
            <nav class="breadcrumb m-3">
                <a class="breadcrumb-item" href="/">Home</a>
                <a class="breadcrumb-item"
                   href="{{ route('products.byCategory', ['category' => $category->name, 'type'=> $product->type]) }}">{{ $typeLabel }}</a>
                <a class="breadcrumb-item"
                   href="{{ route('products.byCategory', ['category'=> $category->name]) }}">{{ $categoryLabel }}</a>
                <span class="breadcrumb-item active">  {{ "{$brand->name} - {$product->name}" }}</span>
            </nav>
        </div>


        <div class="container my-4">
            <div class="row">
                <div class="col-md-6">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-img="../img/Mikina1.png">
                        <div class="col-md-6 text-center">
                            <img src="{{ asset($currentVariant->mainImage->image_path) }}"
                                 alt="Produkt" class="img-fluid main-image"/>
                        </div>
                    </a>

                    <div class="d-flex gap-3 mt-3 thumbnail-container">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-img="../img/Mikina1.png">
                            <img src="../img/Mikina1.png" alt="Miniatúra 1" class="img-thumbnail"
                                 style="width: 100px; height: 100px;">
                        </a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-img="../img/Mikina2.png">
                            <img src="../img/Mikina2.png" alt="Miniatúra 2" class="img-thumbnail"
                                 style="width: 100px; height: 100px;">
                        </a>
                    </div>

                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel">Zväčšený obrázok</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img id="modalImage" src="" alt="Zväčšený obrázok" class="img-fluid w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <h1>{{ $product->name }}</h1>
                    <p><strong>Popis</strong><br>{{ $product->description }}</p>
                    <div class="text-success h4">{{ $product->price }} €</div>
                    <div class="text-success mb-3">Na sklade</div>

                    <form class="row g-3 align-items-end">
                        <div class="col-2">
                            <label for="quantity" class="form-label">Počet</label>
                            <input type="number" class="form-control" id="quantity" value="1" min="1">
                        </div>
                        <div class="col-auto">
                            <label class="form-label mb-2">Farba</label><br>
                            @php
                                $colorsLabel = [
                                    'red'    => ['symbol' => '🔴', 'label' => 'Červená'],
                                    'green'  => ['symbol' => '🟢', 'label' => 'Zelená'],
                                    'blue'   => ['symbol' => '🔵', 'label' => 'Modrá'],
                                    'yellow' => ['symbol' => '🟡', 'label' => 'Žltá'],
                                    'black'  => ['symbol' => '⚫', 'label' => 'Čierna'],
                                    'white'  => ['symbol' => '⚪', 'label' => 'Biela'],
                                    'orange' => ['symbol' => '🟠', 'label' => 'Oranžová'],
                                    'purple' => ['symbol' => '🟣', 'label' => 'Fialová'],
                                    'brown'  => ['symbol' => '🟤', 'label' => 'Hnedá'],
                                ];

                                 $allColorVariants = $allVariants
                                        ->unique('colors_id')
                                        ->values();
                            @endphp
                            <select id="colorSelect" class="form-select">
                                @foreach($allColorVariants as $variant)
                                    @php
                                        $color = $variant->color->name;
                                        $url = route('product.show', [
                                          'product'        => $product->id,
                                          'currentVariant' => $variant->id,
                                        ]);
                                    @endphp

                                    @if(isset($colorsLabel[$color]))
                                        <option
                                            value="{{ $url }}"
                                            @selected($variant->id == $currentVariant->id)
                                        >
                                            {{ $colorsLabel[$color]['symbol'] }}
                                            {{ $colorsLabel[$color]['label'] }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <label for="size" class="form-label">Veľkosť</label>
                            <select id="size" class="form-select">
                                @foreach($sizes as $key)
                                    <option value="{{ $key->id }}">
                                        {{$key->size->size}}</option>
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <button id="cart" type="submit" class="btn btn-primary" data-variant ="{{ $currentVariant->id }}">
                                <i class="fas fa-shopping-cart"></i> Pridať do košíka
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('footer')
    @include('partials.footer2')
@endsection

@push('scripts')
    <script>
        document.getElementById('colorSelect')
            .addEventListener('change', function () {
                if (this.value) {
                    window.location.href = this.value;
                }
            });

        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('cart');
            btn.addEventListener('click', function(event) {
                event.preventDefault();
                const sizeSelect = document.getElementById('size');
                const quantity = document.getElementById('quantity').value;

                const selectedSizeId = sizeSelect.value;
                console.log(
                    `vybraný variant ID: ${selectedSizeId}` +
                    `, počet: ${quantity}`
                );
            });
        });
    </script>
@endpush
