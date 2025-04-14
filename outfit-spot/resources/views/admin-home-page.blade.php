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
            <label>
                <input type="checkbox" name="brand" value="Nike"> Nike
            </label>
            <label>
                <input type="checkbox" name="brand" value="Adidas"> Adidas
            </label>
            <label>
                <input type="checkbox" name="brand" value="Asics"> Asics
            </label>
            <hr>
            <div>Color</div>
            <label>
                <input type="checkbox" name="color" value="Red"> Red <div class="circle"
                    style="background-color: red;"></div>
            </label>
            <label>
                <input type="checkbox" name="color" value="Blue"> Blue <div class="circle"
                    style="background-color: blue;"></div>
            </label>
            <label>
                <input type="checkbox" name="color" value="Green"> Green <div class="circle"
                    style="background-color: green;"></div>
            </label>
            <hr>
            <div>Price</div>
            <div>
                <input type="range">
            </div>
            <button type="submit">Filter</button>
            <a href="admin-add-product.html" class="button-wrapper">
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
            <div class="item">2</div>
            <div class="item">3</div>
            <div class="item">1</div>
            <div class="item">2</div>
            <div class="item">3</div>
            <div class="item">1</div>
            <div class="item">2</div>
            <div class="item">3</div>
            <div class="item">1</div>
            <div class="item">2</div>
            <div class="item">3</div>
            <div class="item">2</div>
            <div class="item">3</div>
            <div class="item">1</div>
            <div class="item">2</div>
            <div class="item">3</div>
            <div class="item">1</div>
            <div class="item">2</div>
            <div class="item">3</div>
            <div class="item">1</div>
            <div class="item">2</div>
            <div class="item">3</div>

            <div class="item">last</div>

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

