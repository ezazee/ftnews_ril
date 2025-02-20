<!--  Menu Panel Sidbear (Mobile Version) -->
<div id="uc-menu-panel" data-uc-offcanvas="overlay: true;">
    <div class="uc-offcanvas-bar bg-white text-dark dark:bg-gray-900 dark:text-white">
        <header class="uc-offcanvas-header hstack justify-between items-center pb-4 bg-white dark:bg-gray-900">
            <div class="uc-logo">
                <a href="/" class="h5 text-none text-gray-900 dark:text-white">
                    <img class="w-64px" src="{{ URL::asset('assets/images/logo/ftlogo.webp') }}" alt="FTNews"
                        data-uc-svg>
                </a>
            </div>
            <button
                class="uc-offcanvas-close p-0 icon-3 btn border-0 dark:text-white dark:text-opacity-50 hover:text-primary hover:rotate-90 duration-150 transition-all"
                type="button">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </header>

        <div class="panel">
            <form id="search-panel" class="form-icon-group vstack gap-1 mb-3" data-uc-sticky=""
                action="{{ route('search') }}" method="GET">
                <input type="text" name="search" class="form-control form-control-md fs-6"
                    placeholder="Cari Artikel...">
                <span class="form-icon text-gray">
                    <button class="border-0 bg-white" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </span>
            </form>
            <ul class="nav-y gap-narrow fw-bold fs-5">
                <li><a href="{{ route('root') }}">Home</a></li>
                <li><a href="{{ route('byindex') }}">Indeks</a></li>
                @foreach ($categories as $category)
                    @if (!$category->subCateg->isEmpty())
                        <li class="uc-parent">
                            <!-- Tampilkan nama kategori -->
                            <a
                                href="{{ route('bycategory', ['categorySlug' => $category->slug]) }}">{{ $category->nama_kategori }}</a>
                            <!-- Tampilkan langsung sub-kategori -->
                            @foreach ($category->subCateg as $subCategory)
                                <ul>
                                    <li>
                                        <a href="{{ route('bycategory', ['categorySlug' => $category->slug, 'subCategorySlug' => $subCategory->slug]) }}"
                                            class="text-gray-400">
                                            {{ $subCategory->nama_sub_kategori }}
                                        </a>
                                    </li>
                                </ul>
                            @endforeach
                        </li>
                    @endif
                @endforeach
                <hr class="m-0" style="height: 3px; width:100%">

                {{-- <li><a target="_blank" class="mt-3" href="https://pemilunesia.com/">Pemilukada</a></li> --}}
                <li><a href="{{ url('/home/redaksi') }}">Redaksi</a></li>
                <li><a href="{{ url('/home/pedoman-media-siber') }}">Pedoman Media Siber</a></li>
                <li><a href="{{ url('/home/standar-perlindungan-profesi-wartawan') }}">Standar Perlidungan Profesi
                        Wartawan</a></li>
                <li><a href="{{ url('/home/kode-etik-jurnalistik') }}">Kode Etik Jurnalistik</a></li>

            </ul>

            <hr class="m-0" style="height: 3px; width:100%">

            <div class="d-inline-block mt-5">
                <h4 class="h6 m-0 text-black">Ikuti Kami:</h4>
            </div>
            <ul class="footer-social nav-x gap-2 mt-2">
                @foreach ($media as $me)
                    <li>
                        <a class="text-primary hover:text-gray-900 dark:hover:text-white duration-150"
                            href="{{ $me->facebook }}" target="_blank"><i
                                class="icon icon-2 fa-brands fa-facebook"></i></a>
                    </li>
                    <li>
                        <a class="text-primary hover:text-gray-900 dark:hover:text-white duration-150"
                            href="{{ $me->twitter }}" target="_blank"><i
                                class="icon icon-2 fa-brands fa-x-twitter"></i></a>
                    </li>
                    <li>
                        <a class="text-primary hover:text-gray-900 dark:hover:text-white duration-150"
                            href="{{ $me->instagram }}" target="_blank"><i
                                class="icon icon-2 fa-brands fa-instagram"></i></a>
                    </li>
                    <li>
                        <a class="text-primary hover:text-gray-900 dark:hover:text-white duration-150"
                            href="{{ $me->tiktok }}" target="_blank"><i
                                class="icon icon-2 fa-brands fa-tiktok"></i></a>
                    </li>
                    <li>
                        <a class="text-primary hover:text-gray-900 dark:hover:text-white duration-150"
                            href="{{ $me->youtube }}" target="_blank"><i
                                class="icon icon-2 fa-brands fa-youtube"></i></a>
                    </li>
                @endforeach
            </ul>
            <div class="py-2 hstack gap-2 mt-4 bg-white dark:bg-gray-900" data-uc-sticky="position: bottom">
                <div class="vstack gap-1">
                    <span class="fs-7 opacity-60">Pilih Tema:</span>
                    <div class="darkmode-trigger" data-darkmode-switch="">
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider fs-5"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  Bottom Actions Sticky -->
<div class="backtotop-wrap position-fixed bottom-0 end-0 z-99 m-2 vstack">
    <div class="uc-modes-trigger btn btn-xs w-32px h-32px p-0 bg-gray-100 d-none d-md-inline-flex border fw-normal rounded-circle dark:text-dark dark:bg-grey-200 hover:bg-gray-25 dark:hover:bg-gray-200"
        data-darkmode-toggle="">
        <label class="switch">
            <span class="sr-only">Dark toggle</span>
            <input type="checkbox">
            <span class="slider"></span>
        </label>
    </div>
    <a class="btn btn-sm btn-primary dark:bg-gray-700 text-primary-message dark:text-white w-40px h-40px rounded-circle"
        href="to_top.html" data-uc-backtotop>
        <i class="fa-solid fa-chevron-up"></i>
    </a>
</div>

<!-- Iklan Section 1 start -->
<div class="section panel overflow-hidden">
    <div class="section-outer panel pt-2">
        <div class="container max-w-lg text-center">
            <div class="section-inner">
                <a class="text-none" href="#" rel="nofollow">
                    <!-- Iklan untuk desktop -->
                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"
                         crossorigin="anonymous"></script>
                    <!-- leaderboard desktop -->
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-7366174212541814"
                         data-ad-slot="5448457787"
                         data-ad-format="auto"
                         data-full-width-responsive="true"></ins>
                    <script>
                         (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                    <!-- Iklan untuk mobile -->
                    <div id="ad-mobile" class="d-block d-md-none mx-auto">
                        <div class="">
                            <!--<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"-->
                            <!--     crossorigin="anonymous"></script>-->
                            <!-- leaderboard mobile -->
                            <!--<ins class="adsbygoogle"-->
                            <!--     style="display:inline-block;width:320px;height:400px"-->
                            <!--     data-ad-client="ca-pub-7366174212541814"-->
                            <!--     data-ad-slot="3566690049"></ins>-->
                            <!--<script>-->
                            <!--     (adsbygoogle = window.adsbygoogle || []).push({});-->
                            <!--</script>-->
                            <div class="bg-primary-message">
                                <p class="text-primary-message">scroll untuk melanjutkan</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Iklan Section 1 end -->

<!-- Header start -->
<header class="uc-header uc-navbar-sticky-wrap z-999"
    data-uc-sticky="sel-target: .uc-navbar-container; cls-active: uc-navbar-sticky; cls-inactive: uc-navbar-transparent;">
    <nav class="uc-navbar-container bg-white dark:bg-gray-custom fs-6 z-1">
        <div class="uc-center-navbar panel z-2">
            <div class="container max-w-lg">
                <div class="uc-navbar min-h-72px lg:min-h-80px text-gray-900 dark:text-white"
                    data-uc-navbar="animation: uc-animation-slide-top-small; duration: 150;">
                    <div class="uc-navbar-left">
                        <div class="uc-logo d-block md:d-none">
                            <a href="/">
                                <img class="w-100px d-none dark:d-block"
                                    src="{{ URL::asset('assets/images/logo/ftlogo.webp') }}" alt="FTNews">
                                <img class="w-100px d-block dark:d-none"
                                    src="{{ URL::asset('assets/images/logo/ftlogo.webp') }}" alt="FTNews">
                            </a>
                        </div>
                        <div class="uc-logo d-none md:d-block">
                            <a href="/">
                                <img class="w-100px d-none dark:d-block"
                                    src="{{ URL::asset('assets/images/logo/ftlogo.webp') }}" alt="FTNews">
                                <img class="w-100px d-block dark:d-none"
                                    src="{{ URL::asset('assets/images/logo/ftlogo.webp') }}" alt="FTNews">
                            </a>
                        </div>
                    </div>
                    <div class="uc-navbar-center">
                        <ul class="uc-navbar-nav fw-bold d-none lg:d-flex">
                            <li><a href="{{ route('root') }}"
                                    class="custom-nav-link text-gray-400 {{ Request::routeIs('root') ? 'active-link' : '' }}">Home</a>
                            </li>
                            <li><a href="{{ route('byindex') }}"
                                    class="custom-nav-link text-gray-400 {{ Request::routeIs('byindex') ? 'active-link' : '' }}">Indeks</a>
                            </li>

                            @foreach ($categories as $item)
                                <li>
                                    <a href="{{ route('bycategory', ['categorySlug' => $item->slug]) }}"
                                        class="custom-nav-link text-gray-400
                                    {{ Request::is('category/' . $item->slug) || Request::is('category/' . $item->slug . '/*') ? 'active-link' : '' }}">
                                        {{ $item->nama_kategori }}
                                    </a>
                                </li>
                            @endforeach
                        <!--    {{-- <li><a target="_blank" class="custom-nav-link text-gray-400"-->
                        <!--href="https://pemilunesia.com/">Pemilukada</a> --}}-->
                            </li>
                        </ul>
                    </div>
                    <div class="uc-navbar-right">
                        {{-- Search --}}
                        <div class="uc-navbar-item d-none d-lg-flex">
                            <form class="hstack gap-1 p-narrow dark:border-gray-700" action="{{ route('search') }}"
                                method="GET" style="width: 150px">
                                <input type="text" name="search"
                                    class="form-control-plaintext ms-1 dark:text-white" placeholder="Cari Artikel.."
                                    aria-label="Search" style="font-size: 12px;" />
                                <button type="submit"
                                    class="uc-search-trigger border-none bg-transparent cstack text-none text-dark dark:text-white"
                                    aria-label="Search Button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                        {{-- Dark Toogle --}}
                        <div class="d-block d-lg-none">
                            <div class="uc-modes-trigger btn btn-xs w-32px h-32px p-0 border fw-normal rounded-circle dark:text-white hover:bg-gray-25 dark:hover:bg-gray-900"
                                data-darkmode-toggle="">
                                <label class="switch">
                                    <span class="sr-only">Dark toggle</span>
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>

                        {{-- Mobile --}}
                        <div class="d-block lg:d-none">
                            <a class="uc-menu-trigger" href="#uc-menu-panel" data-uc-toggle>
                                <svg fill="#000000" width="50" height="50" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" width="24px" height="24px">
                                    <path
                                        d="M 4 3 C 3.448 3 3 3.448 3 4 L 3 6 C 3 6.552 3.448 7 4 7 L 6 7 C 6.552 7 7 6.552 7 6 L 7 4 C 7 3.448 6.552 3 6 3 L 4 3 z M 11 3 C 10.448 3 10 3.448 10 4 L 10 6 C 10 6.552 10.448 7 11 7 L 13 7 C 13.552 7 14 6.552 14 6 L 14 4 C 14 3.448 13.552 3 13 3 L 11 3 z M 18 3 C 17.448 3 17 3.448 17 4 L 17 6 C 17 6.552 17.448 7 18 7 L 20 7 C 20.552 7 21 6.552 21 6 L 21 4 C 21 3.448 20.552 3 20 3 L 18 3 z M 4 10 C 3.448 10 3 10.448 3 11 L 3 13 C 3 13.552 3.448 14 4 14 L 6 14 C 6.552 14 7 13.552 7 13 L 7 11 C 7 10.448 6.552 10 6 10 L 4 10 z M 11 10 C 10.448 10 10 10.448 10 11 L 10 13 C 10 13.552 10.448 14 11 14 L 13 14 C 13.552 14 14 13.552 14 13 L 14 11 C 14 10.448 13.552 10 13 10 L 11 10 z M 18 10 C 17.448 10 17 10.448 17 11 L 17 13 C 17 13.552 17.448 14 18 14 L 20 14 C 20.552 14 21 13.552 21 13 L 21 11 C 21 10.448 20.552 10 20 10 L 18 10 z M 4 17 C 3.448 17 3 17.448 3 18 L 3 20 C 3 20.552 3.448 21 4 21 L 6 21 C 6.552 21 7 20.552 7 20 L 7 18 C 7 17.448 6.552 17 6 17 L 4 17 z M 11 17 C 10.448 17 10 17.448 10 18 L 10 20 C 10 20.552 10.448 21 11 21 L 13 21 C 13.552 21 14 20.552 14 20 L 14 18 C 14 17.448 13.552 17 13 17 L 11 17 z M 18 17 C 17.448 17 17 17.448 17 18 L 17 20 C 17 20.552 17.448 21 18 21 L 20 21 C 20.552 21 21 20.552 21 20 L 21 18 C 21 17.448 20.552 17 20 17 L 18 17 z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="uc-bottom-navbar d-lg-none d-xl-none panel z-1 min-h-32px lg:min-h-48px lg:hidden bg-primary uc-dark"
            data-uc-navbar="animation: uc-animation-slide-top-small; duration: 150;" style="margin-top: -20px;">
            <div class="container max-w-xl">
                <div class="hstack">
                    <div class="uc-navbar-left gap-2 lg:gap-3">
                        <div class="uc-navbar-item">
                            <ul
                                class="nav-x-navMobile fs-6 fw-bold flex-nowrap overflow-x-auto hide-scrollbar uc-horizontal-scroll w-screen md:w-auto md:mask-end-0 mx-n2 px-1">
                                <li><a href="{{ route('root') }}"
                                        class="custom-nav-link text-gray-400 {{ Request::routeIs('root') ? 'active-link' : '' }}">Home</a>
                                </li>
                                <li><a href="{{ route('byindex') }}"
                                        class="custom-nav-link text-gray-400 {{ Request::routeIs('byindex') ? 'active-link' : '' }}">Indeks</a>
                                </li>
                                @foreach ($categories as $item)
                                    <li>
                                        <a href="{{ route('bycategory', ['categorySlug' => $item->slug]) }}"
                                            class="custom-nav-link text-gray-400
                                {{ Request::is('category/' . $item->slug) || Request::is('category/' . $item->slug . '/*') ? 'active-link' : '' }}">
                                            {{ $item->nama_kategori }}
                                        </a>
                                    </li>
                                @endforeach
                                <!--{{-- <li><a class="text-gray-400 custom-nav-link" target="_blank" href="https://pemilunesia.com/">Pemilukada</a></li> --}}-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </nav>
</header>

<!-- Header end -->
