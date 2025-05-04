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
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
@endpush

@section('title', 'Add Product')

@section('favicon')
    {{ asset('img/logo-white.svg') }}
@endsection

@section('header')
    @include('partials.user-header')
@endsection

@section('content')
    <div class="container my-3" style="height: 100%">
        <a href="{{ route('adminHome') }}" class="btn btn-link text-decoration-none mb-3">
            <i class="bi bi-arrow-left"></i> Späť
        </a>

        <h2>Pridanie produktu</h2>

        <form id="addProductForm">
            <div class="row">
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label" for="brand">Kategória</label>
                        <select id="category" name="category" class="form-select w-auto" required>
                            <option value="" disabled selected>Vyberte kategóriu</option>
                            @foreach($categories as $category)
                                @switch($category->name)
                                    @case('shirts')
                                        <option value="{{ $category->id }}">Tričká</option>
                                        @break
                                    @case('shoes')
                                        <option value="{{ $category->id }}">Topánky</option>
                                        @break
                                    @case('pants')
                                        <option value="{{ $category->id }}">Nohavice</option>
                                        @break
                                    @case('hoodies')
                                        <option value="{{ $category->id }}">Mikiny</option>
                                        @break
                                @endswitch
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="type">Typ</label>
                        <select id="type" name="type" class="form-select w-auto" required>
                            <option value="" disabled selected>Vyberte typ</option>
                                <option value="male">Muži</option>
                                <option value="female">Ženy</option>
                                <option value="kids">Deti</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="brand">Značka</label>
                        <select id="brand" name="brand" class="form-select w-auto" required>
                            <option value="" disabled selected>Vyberte značku</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="product_name">Názov produktu</label>
                        <input type="text" class="form-control" id="product_name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="product_description">Popis produktu</label>
                        <textarea class="form-control" id="product_description" name="description" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="price">Cena</label>
                        <div class="input-group">
                            <span class="input-group-text">€</span>
                            <input type="number" min="0" max="400" step="0.01" class="form-control" id="price" name="price" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="quantity">Počet</label>
                        <div class="input-group">
                            <span class="input-group-text">ks</span>
                            <input type="number" min="1" class="form-control w-auto" id="quantity" name="quantity" placeholder="0" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Farba</label>
                        <div class="row g-3">
                            @php
                                $slovakColors = [
                                    'red' => 'Červená',
                                    'blue' => 'Modrá',
                                    'green' => 'Zelená',
                                    'yellow' => 'Žltá',
                                    'orange' => 'Oranžová',
                                    'purple' => 'Fialová',
                                    'brown' => 'Hnedá',
                                    'black' => 'Čierna',
                                    'white' => 'Biela'
                                ];
                            @endphp
                            @foreach($colors as $color)
                                @php
                                    $key = strtolower($color->name);
                                    $label = $slovakColors[$key] ?? $color->name;
                                @endphp
                                <div class="col">
                                    <input class="form-check-input mt-2" type="radio" name="color" id="color-{{ ltrim($color->hex, '#') }}" value="{{ $color->id }}" required>
                                    <div class="color-sample mt-2" style="background-color: {{ $color->hex }};"></div>
                                    <label class="form-label d-block" for="color-{{ ltrim($color->hex, '#') }}">{{ $label}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="product_type" class="form-label">Veľkosti</label>

                        <div id="size-options" class="d-flex flex-wrap gap-2 mt-2">
                            @php
                                $shirtList = ['XS','S','M','L','XL','XXL'];
                                $shoeList = ['36','37','38','39','40','41','42','43','44','45','46'];
                                $shirtSizes = [];
                                $shoesSizes = [];
                                foreach($sizes as $s) {
                                    if (in_array($s->size, $shirtList)) {
                                        $shirtSizes[] = $s;
                                    } elseif (in_array($s->size, $shoeList)) {
                                        $shoesSizes[] = $s;
                                    }
                                }
                            @endphp

                        @foreach($shirtSizes as $size)
                                <div class="form-check" data-type="clothing">
                                    <input class="form-check-input" type="checkbox" name="size[]" id="size-{{ $size->id }}" value="{{ $size->id }}">
                                    <label class="form-label d-block" for="size-{{ $size->id }}">{{ $size->size }}</label>
                                </div>
                            @endforeach
                            @foreach($shoesSizes as $size)
                                <div class="form-check" data-type="shoes">
                                    <input class="form-check-input" type="checkbox" name="size[]" id="size-{{ $size }}" value="{{ $size->id }}">
                                    <label class="form-label d-block" for="size-{{ $size }}">{{ $size->size }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                    <label class="form-label">Nahrajte obrazky</label>
                    <div>

                        <div class="mb-3">
                            <div class="input-group">
                                <input class="form-control" type="file" id="image"
                                       accept="image/png, image/jpeg">
                                <button class="btn btn-outline-secondary" id="uploadImageButton" type="button">Nahrať</button>
                            </div>
                        </div>

                        <div id="preview" class="d-flex justify-content-between gap-2 mt-3"></div>

                    </div>
                </div>

                <div class="d-flex justify-content-end my-4">
                    <button class="btn btn-success" type="submit">Pridať produkt</button>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('addProductForm')
                const uploadBtn = document.getElementById('uploadImageButton');
                const fileInput = document.getElementById('image');
                const preview = document.getElementById('preview');

                window.uploadedImagePaths = window.uploadedImagePaths || [];

                uploadBtn.addEventListener('click', function() {
                    const files = fileInput.files;
                    if (!files.length) {
                        alert('Prosím, vyberte súbor!');
                        return;
                    }
                    const formData = new FormData();
                    Array.from(files).forEach((file, idx) => {
                        formData.append('images[' + idx + ']', file);
                    });
                    formData.append('_token', '{{ csrf_token() }}');

                    fetch('{{ route('admin.products.uploadImage') }}', {
                        method: 'POST',
                        body: formData,
                    })
                        .then(response => response.json())
                        .then(data => {
                            window.uploadedImagePaths.push(data.path);

                            const img = document.createElement('img');
                            img.src = '/' + data.path;
                            img.classList.add('img-fluid', 'rounded');
                            img.style.maxWidth = '360px';
                            img.style.maxHeight = '360px';
                            preview.appendChild(img);

                            fileInput.value = null;
                        })
                        .catch(() => alert('Chyba pri nahrávaní.'));
                });

                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    if (window.uploadedImagePaths.length < 1) {
                        alert('Prosím, nahrajte obrázok.');

                        return;
                    }

                    // console.log(window.uploadedImagePaths.length)

                    const formData = new FormData(form);
                    formData.append('images', JSON.stringify(window.uploadedImagePaths));
                    formData.append('_token', '{{ csrf_token() }}');

                    fetch('{{ route('admin.products.store') }}', {
                        method: 'POST',
                        body: formData,
                    })
                        .then(response => {
                            if (response.status === 204) {
                                alert('Produkt bol úspešne pridaný.');
                                window.location.href = '{{ route('adminHome') }}';
                            }else {
                                alert('Chyba pri pridávaní produktu.');
                            }
                        })
                        .catch(() => alert('Chyba pri pridávaní produktu.'));
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                const typeSelect = document.getElementById('category');
                const sizeContainers = document.querySelectorAll('#size-options .form-check');

                function toggleSizes() {
                    const type = typeSelect.value;
                    sizeContainers.forEach(el => {
                        const dt = el.getAttribute('data-type');
                        if ((type === '1' && dt === 'clothing') || (type === '2' && dt === 'clothing') || (type === '3' && dt === 'clothing') || (type === '4' && dt === 'shoes')) {
                            el.style.display = 'flex';
                        } else {
                            el.style.display = 'none';
                            el.querySelector('input').checked = false;
                        }
                    });
                }

                typeSelect.addEventListener('change', toggleSizes);
                toggleSizes();
            });
        </script>
    @endpush
@endsection
