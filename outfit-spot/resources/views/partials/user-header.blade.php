<header>
    <div class="navbar-top">
        <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="/homepage">
                <img src="{{asset('img/logo-white.svg')}}" alt="Logo" width="70" class=" align-text-top" />
            </a>
            <div class="search-wrapper w-100 my-2">
                <div class="search-bar mx-auto">
                    <input type="search" placeholder="Hľadať...">
                    <button class="btn btn-outline-dark rounded-end-pill" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
            <div class="d-flex">
                @guest
                    <a href="/login" class="btn btn-link text-white me-3">
                        <i class="bi bi-person-circle fs-4"></i>
                    </a>
                @endguest
                @auth
                    <!-- this should point to the profile page if we get to creating one -->
                    <a href="/" class="btn btn-link text-white me-3">
                        <p>Welcome, {{Auth::user()->first_name}}!</p>
                    </a>
                @endauth
                <a href="/checkout" class="btn btn-link text-white">
                    <i class="bi bi-cart fs-4"></i>
                </a>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg custom-navbar main-navbar">
        <div class="container">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-black mx-3" role="button" data-bs-toggle="dropdown"
                           href="#">Muži</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Tričká</a></li>
                            <li><a class="dropdown-item" href="#">Mikiny</a></li>
                            <li><a class="dropdown-item" href="#">Nohavice</a></li>
                            <li><a class="dropdown-item" href="#">Topánky</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-black mx-3" role="button" data-bs-toggle="dropdown"
                           href="#">Ženy</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Tričká</a></li>
                            <li><a class="dropdown-item" href="#">Mikiny</a></li>
                            <li><a class="dropdown-item" href="#">Nohavice</a></li>
                            <li><a class="dropdown-item" href="#">Topánky</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle text-black mx-3" role="button" data-bs-toggle="dropdown"
                           href="#">Deti</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Tričká</a></li>
                            <li><a class="dropdown-item" href="#">Mikiny</a></li>
                            <li><a class="dropdown-item" href="#">Nohavice</a></li>
                            <li><a class="dropdown-item" href="#">Topánky</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black mx-3" href="#">Kontakt</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
