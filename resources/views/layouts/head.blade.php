<p id="menuBtn"><span>Menu</span></p>

<header>

    <div class="langauth">
        <!-- <ul id="headerLang">
            <li>
                <a href="#">
                    <img src="/img/INA.png" alt="Ind" srcset="">
                    <span>INA</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="/img/ENG.png" alt="Eng" srcset="">
                    <span>ENG</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="/img/JPY.png" alt="Jpn" srcset="">
                    <span>JPN</span>
                </a>
            </li>
        </ul> -->

        <ul id="headerAuth">
            @if(Route::has('login'))
            <div class="userAuth">
                @auth
                <a href="{{ url('dashboard') }}" class="underline"></a>
                @else
                <a href="{{ url('login') }}" class="underline"><span>Login</span></a>
                @if(Route::has('register'))
                <a href="{{ url('register') }}" class="underline"><span>Register</span></a>
                @endif
                @endauth
            </div>
            @endif
        </ul>
    </div>
    <h1><a href="/">NIJ Logo</a></h1>


</header>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav menu">
                <li class="nav-item">
                    <a href="/" class="nav-link"><span>Home</span></a>
                    <!-- =============== -->
                    <!-- <a href="/about" class="nav-link"><span>{{ __("bahasa.list2") }}</span></a> -->
                    <!-- =============== -->
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link" id="navbarDrop" data-bs-toggle="dropdown"><span>NIJ Product</span></a>

                    <!-- =============== -->
                    <!-- <a href="#" class="nav-link" id="navbarDrop" data-bs-toggle="dropdown"><span>{{ __("bahasa.list1") }}</span></a> -->
                    <!-- =============== -->

                    <ul class="dropdown-menu">
                        @foreach(getProducts() as $item)
                        <li><a href="/posts?productcategory={{ $item->slug }}" class="dropdown-item">{{ $item->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/about" class="nav-link"><span>About Us</span></a>
                    <!-- =============== -->
                    <!-- <a href="/about" class="nav-link"><span>{{ __("bahasa.list2") }}</span></a> -->
                    <!-- =============== -->
                </li>

                <!-- <li class="nav-item">
                    <a href="/computers/computer" aria-current="page" class="nav-link active"><span>{{ __("bahasa.list3") }}</span></a>
                    <a href="/computers/computer" aria-current="page" class="nav-link active"><span>Upload PC Data</span></a>
                    <a href="/computers/importxls" aria-current="page" class="nav-link active"><span>Upload PC Data</span></a>
                </li> -->

            </ul>
        </div>
    </div>
</nav>