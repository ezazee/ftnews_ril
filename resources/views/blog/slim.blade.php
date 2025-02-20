@extends('blog.partials.app')
@section('content')
    <div id="wrapper" class="wrap overflow-hidden-x">

        {{-- Iklan (Mobile Only) --}}
        {{-- <div class="mobile-banner" id="mobileBanner">
            <div class="ad-close">
                <button class="close-ad-btn" id="closeBannerBtn">Close Ads ✖</button>
            </div>
            <img src="{{ asset('assets/images/common/iklan-1(320x50).jpg') }}" alt="Mobile Ad">
        </div> --}}
        {{-- Iklan (Mobile Only) END --}}

        {{-- Partner Logos Section --}}
        <section class="partners-section text-center py-5">
            <div class="container max-w-lg">
                <img src="{{ asset('assets/images/logo/media-partners/slimonline.png') }}" alt="Slim Online" class="img-fluid mb-5" style="max-height: 70px; width: auto;">

                <div class="row row-cols-2 bg-slim rounded-md row-cols-md-3 row-cols-lg-6 p-4 g-4">
                    <!-- Logo 1 -->
                    <div class="col text-center">
                        <a href="https://automoto.id/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('assets/images/logo/media-partners/automoto-blck.png') }}" alt="Automoto" class="img-fluid" style="max-height: 80px; width: auto;">
                        </a>
                    </div>
                    <!-- Logo 2 -->
                    <div class="col text-center">
                        <a href="https://ikngreen.id/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('assets/images/logo/media-partners/ikngreen.png') }}" alt="IKN Green" class="img-fluid" style="max-height: 80px; width: auto;">
                        </a>
                    </div>
                    <!-- Logo 3 -->
                    <div class="col text-center">
                        <a href="https://indopop.id/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('assets/images/logo/media-partners/indopop.png') }}" alt="Indopop" class="img-fluid" style="max-height: 80px; width: auto;">
                        </a>
                    </div>
                    <!-- Logo 4 -->
                    <div class="col text-center">
                        <a href="https://satukata.net/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('assets/images/logo/media-partners/satukata.png') }}" alt="Satukata" class="img-fluid" style="max-height: 80px; width: auto;">
                        </a>
                    </div>
                    <!-- Logo 5 -->
                    <div class="col text-center">
                        <a href="https://terasmalioboronews.com/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('assets/images/logo/media-partners/terasmalioboro.png') }}" alt="Teras Malioboro News" class="img-fluid" style="max-height: 80px; width: auto;">
                        </a>
                    </div>
                    <!-- Logo 6 -->
                    <div class="col text-center">
                        <a href="https://tobanews.com/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('assets/images/logo/media-partners/tobanews.png') }}" alt="Tobanews" class="img-fluid" style="max-height: 80px; width: auto;">
                        </a>
                    </div>
                    <!-- Logo 7 -->
                    <div class="col text-center">
                        <a href="https://milenialasik.com/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('assets/images/logo/media-partners/milenial-blck.png') }}" alt="Milenial Asik" class="img-fluid" style="max-height: 80px; width: auto;">
                        </a>
                    </div>
                    <!-- Logo 8 -->
                    <div class="col text-center">
                        <a href="https://voxindonews.com/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('assets/images/logo/media-partners/voxindo.png') }}" alt="Voxindo News" class="img-fluid" style="max-height: 80px; width: auto;">
                        </a>
                    </div>
                    <!-- Logo 9 -->
                    <div class="col text-center">
                        <a href="https://jayakartanews.com/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('assets/images/logo/media-partners/jayakarta.png') }}" alt="Jayakarta" class="img-fluid" style="max-height: 80px; width: auto;">
                        </a>
                    </div>
                    <!-- Logo 10 -->
                    <div class="col text-center">
                        <a href="https://pilarmerdeka.com/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('assets/images/logo/media-partners/pilar.png') }}" alt="Pilar Merdeka" class="img-fluid" style="max-height: 80px; width: auto;">
                        </a>
                    </div>
                </div>

                <!-- Related Posts Section -->
                <div class="post-related panel text-start pt-2 xl:mt-5">
                    <h4 class="h5 xl:h4">Topik Terkini</h4>
                    <div class="row child-cols-6 md:child-cols-3 gx-2 gy-4 sm:gx-3 sm:gy-6">
                        @foreach ($postTerkini as $terkini)
                            <div>
                                <article class="post type-post panel vstack gap-2">
                                    <figure class="featured-image m-0 ratio ratio-4x3 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                        @if (!empty($terkini->gambar) && is_array($terkini->gambar))
                                            @php $firstImage = $terkini->gambar[0]; @endphp
                                            <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                                 src="{{ asset('storage/' . $firstImage) }}"
                                                 alt="{{ $terkini->title }}" data-uc-img="loading: lazy">
                                        @endif
                                        <a href="{{ route('bytitle', ['slug' => $terkini->slug]) }}" class="position-cover" data-caption="{{ $terkini->title }}"></a>
                                    </figure>
                                    <div class="post-header panel vstack gap-1">
                                        <h5 class="h6 md:h5 m-0">
                                            <a class="text-none" href="{{ route('bytitle', ['slug' => $terkini->slug]) }}">{{ $terkini->title }}</a>
                                        </h5>
                                        <div class="post-date hstack gap-narrow fs-7 opacity-60">
                                            <span>{{ $terkini->created_at->translatedFormat('j F Y') }}</span>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Related Posts Section -->
                <div class="post-related panel text-start pt-5 xl:mt-5">
                    <h4 class="h5 xl:h4">Topik Popular</h4>
                    <div class="row child-cols-6 md:child-cols-3 gx-2 gy-4 sm:gx-3 sm:gy-6">
                        @foreach ($populer as $popular)
                            <div>
                                <article class="post type-post panel vstack gap-2">
                                    <figure class="featured-image m-0 ratio ratio-4x3 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                        @if (!empty($popular->gambar) && is_array($popular->gambar))
                                            @php $firstImage = $popular->gambar[0]; @endphp
                                            <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                                 src="{{ asset('storage/' . $firstImage) }}"
                                                 alt="{{ $popular->title }}" data-uc-img="loading: lazy">
                                        @endif
                                        <a href="{{ route('bytitle', ['slug' => $popular->slug]) }}" class="position-cover" data-caption="{{ $popular->title }}"></a>
                                    </figure>
                                    <div class="post-header panel vstack gap-1">
                                        <h5 class="h6 md:h5 m-0">
                                            <a class="text-none" href="{{ route('bytitle', ['slug' => $popular->slug]) }}">{{ $popular->title }}</a>
                                        </h5>
                                        <div class="post-date hstack gap-narrow fs-7 opacity-60">
                                            <span>{{ $popular->created_at->translatedFormat('j F Y') }}</span>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        {{-- Partner Logos Section END --}}

        {{-- Iklan Bawah (Dekstop) --}}
        {{-- <div class="ad-banner" id="adBanner">
            <div class="ad-close">
                <button class="close-ad-btn" id="closeAdBtn">Close Ads ✖</button>
            </div>
            <div class="ad-content">
                <p class="dark:text-dark">Advertisement</p>
                <a href="https://indopop.id" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('assets/images/common/iklan-1(320x50).jpg') }}" alt="Indopop" class="img-fluid">
                </a>
            </div>
        </div> --}}
    </div>
@endsection
