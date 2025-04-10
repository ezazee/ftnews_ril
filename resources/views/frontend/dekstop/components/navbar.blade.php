<header class="header-fix">
    <div class="main-header">
        <div class="header-container">
            <div class="logo-wrap">
                <a href="/">
                    <img alt="Indopop.id" width="120" height="30" src="{{ asset('frontend/logo/logo.svg') }}" />
                </a>
            </div>
            <div class="fr">
                <div class="main-menu-wrap">
                    <div class="main-menu-container">
                        <ul class="main-menu">
                            <li class="menu-item">
                                <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Home</a>
                            </li>
                            {{-- @foreach ($categories as $item) --}}
                            {{-- <li class="menu-item dropdown">
                                {{-- <a href="{{ route('kanal.desktop', ['slug' => $item->slug]) }}" class="{{ Request::is('category/' . $item->slug) ? 'active' : '' }}">{{$item->nama_kategori}}</a> --}}
                                {{-- <ul class="dropdown-menu">
                                    <li><a href="{{ url('/kanal/sub1') }}">Sub Kanal 1</a></li>
                                    <li><a href="{{ url('/kanal/sub2') }}">Sub Kanal 2</a></li>
                                    <li><a href="{{ url('/kanal/sub3') }}">Sub Kanal 3</a></li>
                                    <li><a href="{{ url('/kanal/sub4') }}">Sub Kanal 4</a></li>
                                </ul>
                            </li> --}}
                            <li class="menu-item">
                                <a href="{{ route('staticat.desktop') }}" class="">Nasional</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('staticat.desktop') }}" class="">Daerah</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('staticat.desktop') }}" class="">Lifestyle</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('staticat.desktop') }}" class="">Teknologi</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('staticat.desktop') }}" class="">Olahraga</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('staticat.desktop') }}" class="">Otomotif</a>
                            </li>
                            {{-- @endforeach --}}
                            <li class="menu-item">
                                <a href="https://www.youtube.com/@indopopid" target="_blank">Video</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ url('/indeks') }}"
                                    class="{{ Request::is('indeks') ? 'active' : '' }}">Indeks</a>
                            </li>
                        </ul>

                    </div>
                    <div class="search-container">
                        <div class="search-wrap" id="search-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('searchResult.dekstop') }}" method="GET">
        <div class="wrap-search-form hidden" id="search-form">
            <input type="text" name="q" class="input-search" placeholder="Cari di sini..." required>
            <button type="submit" class="button-search">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-search" viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
            </button>
        </div>
    </form>
    <div class="today-news-container" style="position: fixed; margin-top:50px; z-index: 9999;">
        <div class="today-headline">Terpopuler</div>
        <div class="news-marquee-container">
            <div class="news-marquee-text">
                <ul>
                    @foreach ($postTerpopuler as $item)
                        <li><a href="{{ route('detail.desktop', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</header>
