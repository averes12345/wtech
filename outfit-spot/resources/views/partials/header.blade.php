<header>
    <a class="logo" href="/"> </a>
    <div class="search-wrapper">
        <form class="search-bar">
            <input type="search" placeholder="Search" />
            <button type="submit">
                <div id="magnifying-glass">
                </div>
            </button>
        </form>
    </div>
    <div style="display:flex;">
        <a href="/" class="btn btn-link text-white me-3">
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
