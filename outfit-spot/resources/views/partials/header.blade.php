<header>
    <a class="logo" href="/">
        <img src="{{ asset('img/logo-white.svg') }}" alt="Logo" width="75" class=" align-text-top" />
    </a>
    <div class="search-wrapper">
        <!-- <form method="GET" action="{{route('products.find')}}" class="search-bar"> -->
        <div class="search-bar">
            <input form="filter" type="search" name="search" placeholder="Search" value="{{request('search')}}" />
            <button id="search-submit" form="filter" class="btn btn-outline-dark rounded-end-pill" type="submit" >
                    <i class="fas fa-search"></i>
            </button>

            <!-- <button type="submit"> -->
            <!--     <div id="magnifying-glass"> -->
            <!--     </div> -->
            <!-- </button> -->
        <!-- </form> -->
        </div>
    </div>
    <div style="display:flex;">
        <a href="/admin/home" class="btn btn-link text-white me-3">
            <p>Welcome admin, {{Auth::guard('admin')->user()->first_name}}!</p>
        </a>

        <form action="{{ route('login.logout') }}" method="POST" id="logout-form">
            @csrf
        </form>
        <button type="submit" form="logout-form" style="all: unset; cursor: pointer;" class="log-out">
            <div id="log-out-icon"></div>
        </button>

        <!--
        <a class="people-circle" href="../src/login-page.html">
            <div id="people-circle"></div>
        </a>
        <a class="cart-fill" href="../src/basket-page.html">
            <div id="cart-fill"></div>
        </a>

    -->
    </div>

</header>
