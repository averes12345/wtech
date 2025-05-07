@extends('layouts.admin_basic_layout')

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

@section('title', 'Edit Product')

@section('favicon')
    {{ asset('img/logo-white.svg') }}
@endsection

{{--@section('header')--}}
{{--    @include('partials.user-header')--}}
{{--@endsection--}}

@section('content')
    <div class="container my-3" style="height: 100%">
        <a href="{{ route('adminHome') }}" class="btn btn-link text-decoration-none mb-3">
            <i class="bi bi-arrow-left"></i> Späť
        </a>

        <h2>Upravenie produktu</h2>

        <form id="editProductForm">
            <div class="row">
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label" for="category">Kategória</label>
                        <select id="category" name="category" class="form-select w-auto" required>
                            <option value="" disabled>Vyberte kategóriu</option>
                            @foreach($categories as $category)
                                @php
                                    switch($category->name) {
                                        case 'shirts':   $label = 'Tričká'; break;
                                        case 'shoes':    $label = 'Topánky'; break;
                                        case 'pants':    $label = 'Nohavice'; break;
                                        case 'hoodies':  $label = 'Mikiny'; break;
                                        default:         $label = ucfirst($category->name);
                                    }
                                @endphp
                                <option
                                    value="{{ $category->id }}"
                                    {{ ($currentCategory->id === $category->id ? 'selected' : '') }}
                                >
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mb-3">
                        <label class="form-label" for="type">Typ</label>
                        <select id="type" name="type" class="form-select w-auto" required>
                            <option value="" disabled selected>Vyberte typ</option>
                            <option value="male" {{ ($product->type === 'male' ? 'selected' : '') }}>Muži</option>
                            <option value="female" {{ ($product->type === 'female' ? 'selected' : '') }} >Ženy</option>
                            <option value="kids" {{ ($product->type === 'kids' ? 'selected' : '') }}>Deti</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="brand">Značka</label>
                        <select id="brand" name="brand" class="form-select w-auto" required>
                            <option value="" disabled selected>Vyberte značku</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ ($currentBrand->id === $brand->id ? 'selected' : '') }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="product_name">Názov produktu</label>
                        <input
                            type="text"
                            class="form-control"
                            value="{{ $product->name ?? '' }}"
                            id="product_name"
                            name="name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="product_description">Popis produktu</label>
                        <textarea class="form-control" id="product_description" name="description" rows="3" required>{{ $product->description ?? '' }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="price">Cena</label>
                        <div class="input-group">
                            <span class="input-group-text">€</span>
                            <input type="number" value="{{ $product->price }}" min="0" max="400" step="0.01" class="form-control" id="price" name="price" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="quantity">Počet</label>
                        <div class="input-group">
                            <span class="input-group-text">ks</span>
                            <input type="number" value="{{ $currentVariant->count_in_stock }}" min="1" class="form-control w-auto" id="quantity" name="quantity" placeholder="0" required>
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
                                    <input
                                        class="form-check-input mt-2"
                                        type="radio"
                                        name="color"
                                        id="color-{{ ltrim($color->hex, '#') }}"
                                        value="{{ $color->id }}"
                                        disabled
                                        {{ ($currentVariant->colors_id === $color->id ? 'checked' : '') }}
                                        required>
                                    <div class="color-sample mt-2" style="background-color: {{ $color->hex }};"></div>
                                    <label class="form-label d-block" for="color-{{ ltrim($color->hex, '#') }}">{{ $label}}</label>
                                </div>
                            @endforeach
                            <input type="hidden" name="color" value="{{ $currentVariant->colors_id }}">
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

                                 $currentSizeIds = $currentSizes->pluck('sizes_id')->toArray();


                                $selectedSizes = old('size', $currentSizeIds);
                            @endphp

                            @foreach($shirtSizes as $size)
                                <div class="form-check" data-type="clothing">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="size[]"
                                        id="size-{{ $size->id }}"
                                        value="{{ $size->id }}"
                                        {{ in_array($size->id, (array) $selectedSizes) ? 'checked' : '' }}>
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

                        <div id="preview" class="d-flex flex-row flex-nowrap gap-2 mt-3 overflow-auto"
                             style="overflow-x: auto; overflow-y: hidden;">
                        </div>

                    </div>
                </div>

                <div class="d-flex justify-content-end my-4">
                    <button class="btn btn-success" type="submit">Aktualizovať produkt</button>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            window.uploadedImagePaths = @json($imagePaths ?? []);

            window.uploadedImagePaths.forEach((path, index) => {

                const container = document.createElement('div');
                container.style.position = 'relative';
                container.style.marginRight = '8px';


                const img = document.createElement('img');
                img.src = '/' + path;
                img.classList.add('img-fluid', 'rounded');
                img.style.maxWidth = '360px';
                img.style.maxHeight = '360px';

                const btn = document.createElement('button');
                btn.type = 'button';
                btn.innerHTML = '&times;';
                btn.classList.add('btn', 'btn-sm', 'btn-danger');
                btn.style.position = 'absolute';
                btn.style.top = '4px';
                btn.style.right = '4px';
                btn.style.padding = '0 6px';
                btn.style.lineHeight = '1';

                btn.addEventListener('click', () => {
                    window.uploadedImagePaths.splice(index, 1);
                    container.remove();
                });

                container.appendChild(img);
                container.appendChild(btn);
                preview.appendChild(container);
            });

            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('editProductForm')
                const uploadBtn = document.getElementById('uploadImageButton');
                const fileInput = document.getElementById('image');
                const preview = document.getElementById('preview');

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

                    const formData = new FormData(form);
                    formData.append('images', JSON.stringify(window.uploadedImagePaths));
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('_method', 'PUT');

                    for (const [key, value] of formData.entries()) {
                        console.log(key, value);
                    }

                    fetch('{{ route('admin.products.update', $product->id) }}', {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                        .then(response => {
                            if (response.status === 204) {
                                alert('Produkt bol úspešne aktualizovaný.');
                                window.location.href = '{{ route('adminHome') }}';
                            }else {
                                alert('Chyba pri aktualizovaní produktu.');
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
