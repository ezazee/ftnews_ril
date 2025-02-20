@extends('blog.partials.app')

@section('title', 'Akun')

@section('content')
<div id="wrapper" class="container max-w-screen-lg mx-auto flex flex-wrap justify-between lg:px-8 ms:px-4">


    <!--{{-- Iklan (Mobile Only) --}}-->
    <div class="mobile-banner" id="mobileBanner">
        <div class="ad-close">
            <button class="close-ad-btn" id="closeBannerBtn">Tutup Iklan ✖</button>
        </div>
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"
                 crossorigin="anonymous"></script>
            <!-- sticky-ads-mobile -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:320px;height:50px"
                 data-ad-client="ca-pub-7366174212541814"
                 data-ad-slot="2256815093"></ins>
            <script>
                 (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    <!--{{-- Iklan (Mobile Only) END --}}-->

    <!-- Category 1 start -->
 <div class="section panel overflow-hidden">
    <div class="section-outer panel">
        <div class="container max-w-lg">
            <div class="section-inner">
                <div class="block-layout grid-layout vstack gap-3 lg:gap-4 panel overflow-hidden">
                    <div class="block-content">
                        <div class="row">
                            <div class="col-lg-8">
                                @foreach ($postheadline as $index => $headline)
                                @if ($loop->first)
                                <article class="post type-post panel vstack gap-3 lg:gap-2">
                                    <div class="post-media panel uc-transition-toggle overflow-hidden">
                                        <div class="featured-image-container">
                                            @if (!empty($headline->gambar) && is_array($headline->gambar))
                                            @php
                                            $firstImage = $headline->gambar[0];
                                            @endphp
                                            <img class="featured-image rounded"
                                                src="{{ asset('storage/' . $firstImage) }}"
                                                alt="{{ $headline->title }}" />
                                            @endif

                                            <!-- Efek lipatan sudut kanan bawah -->
                                            <div class="corner-fold"></div>
                                        </div>
                                        <a href="{{ route('bytitle', ['slug' => $headline->slug]) }}"
                                            class="position-cover"></a>
                                    </div>
                                    <div class="post-header panel">
                                        <div
                                            class="post-meta panel hstack justify-start gap-1 fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 md:d-flex z-1">
                                            <div>
                                                <div class="post-category hstack gap-narrow fw-medium">
                                                    <a class="text-none text-primary dark:text-white"
                                                        href="{{ route('bycategory', ['categorySlug' => $headline->kategori->slug]) }}">{{ $headline->kategori->nama_kategori }}</a>
                                                </div>
                                            </div>
                                            <div class="sep md:d-block">❘</div>
                                            <div class="md:d-block">
                                                <div class="post-date hstack gap-narrow">
                                                    <span>{{ $headline->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="post-title h5 bold lg:h4 m-0 text-truncate-3">
                                            <a class="text-none hover:text-primary duration-150"
                                                href="{{ route('bytitle', ['slug' => $headline->slug]) }}">{{ $headline->title }}</a>
                                        </h5>
                                        <p
                                            class="post-excerpt ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">
                                            {!! Str::limit(strip_tags($headline->content), 200) !!}
                                        </p>
                                    </div>
                                </article>
                                <div class="py-4">
                                    <div class="row row-cols-1 row-cols-md-2 g-4">
                                        <!-- Card 1 -->
                                        @else
                                        <div class="col">
                                            <div class="h-100">
                                                <article class="post type-post panel uc-transition-toggle">
                                                    <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                        <div class="col-auto">
                                                            <div
                                                                class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                                <div
                                                                    class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                    @if (!empty($headline->gambar) &&
                                                                    is_array($headline->gambar))
                                                                    @php
                                                                    $firstImage =
                                                                    $headline->gambar[0];
                                                                    @endphp
                                                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque rounded"
                                                                        src="{{ asset('storage/' . $firstImage) }}"
                                                                        data-src="{{ asset('storage/' . $firstImage) }}"
                                                                        alt="{{ $headline->title }}"
                                                                        data-uc-img="loading: lazy" />
                                                                    @endif
                                                                </div>
                                                                <a href="{{ route('bytitle', ['slug' => $headline->slug]) }}"
                                                                    class="position-cover"></a>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div
                                                                class="post-header panel vstack justify-between gap-1">
                                                                <h6
                                                                    class="post-title dark:text-white text-dark lg:h5 m-0 text-truncate-4">
                                                                    <a class="text-none hover:text-primary duration-150"
                                                                        href="{{ route('bytitle', ['slug' => $headline->slug]) }}">{{ $headline->title }}</a>
                                                                </h6>
                                                                <div
                                                                    class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60">
                                                                    <small>{{ $headline->created_at->translatedFormat('j F Y') }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                <!-- Iklan Custom-->
                                <div class="section panel overflow-hidden">
                                    <div class="section-outer panel my-5">
                                        <div class="max-w-lg text-center">
                                            <div class="section-inner">
                                                <a href="https://peskinpro.id/" target="_blank">
                                                    <img class="mx-auto d-block sm:d-none"
                                                        src="{{ asset('assets/images/common/peskinew2.jpg') }}"
                                                        alt="Ad slot" width="728" height="90">
                                                </a>
                                                <a href="https://peskinpro.id/" target="_blank">
                                                    <img class="mx-auto d-none sm:d-block"
                                                        src="{{ asset('assets/images/common/peskinew.jpg') }}"
                                                        alt="Ad slot" width="565" height="565">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="widget ad-widget vstack gap-2 text-center">
                                    <div class="panel gap-2 h-auto">
                                        <div class="widget ad-widget vstack gap-2">
                                                <div class="widget-content">
                                                     <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"
                                                             crossorigin="anonymous"></script>
                                                        <!-- square-1 -->
                                                        <ins class="adsbygoogle"
                                                             style="display:block"
                                                             data-ad-client="ca-pub-7366174212541814"
                                                             data-ad-slot="1865529900"
                                                             data-ad-format="auto"
                                                             data-full-width-responsive="true"></ins>
                                                        <script>
                                                             (adsbygoogle = window.adsbygoogle || []).push({});
                                                        </script>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <aside class="wrapper__list__article mb-4 mt-3">
                                    <h5 class="border_section text-primary fw-bold">Rekomendasi Untuk Anda</h6>
                                    <div class="wrapper__list__article-small">
                                        @foreach ($postTerbaruByTag as $item)
                                        <div class="mb-3">
                                            <div class="card__post card__post-list d-flex align-items-start">
                                                <div class="card__post__body">
                                                    <div class="card__post__content">
                                                        <div class="card__post__title">
                                                            <h6 class="text-dark mb-0">
                                                                <a href="{{ route('bytitle', $item->slug) }}"
                                                                   class="text-none text-dark dark:text-white">
                                                                    {{ $item->title }}
                                                                </a>
                                                            </h6>
                                                             <li class="list-inline-item small text-muted">
                                                                    {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('DD MMMM, YYYY') }}
                                                            </li>
                                                        </div>
                                                        <!-- Display the first tag -->
                                                        @if ($item->tags->isNotEmpty())
                                                        <ul class="nav flex-wrap m-0">
                                                           <li class="list-inline-item">
                                                                <a href="{{ route('bytags', $item->tags->first()->slug) }}"
                                                                   style="padding: 0.2rem 0.4rem; font-size: 0.8rem;"
                                                                   class="badge bg-primary-tag text-white rounded-pill text-decoration-none">
                                                                    {{ $item->tags->first()->nama_tags }}
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </aside>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Category 1 End -->

<!-- Section start -->
<div id="latest_news" class="latest-news section panel">
    <div class="section-outer panel py-4 lg:py-6">
        <div class="container max-w-lg">
            <div class="section-inner">
                <div class="content-wrap row child-cols-12 g-4 lg:g-6" data-uc-grid>
                    <div class="md:col-8">
                        {{-- CATEGORT AWAL (NASIONAL) --}}
                        <div class="main-wrap panel vstack gap-3 lg:gap-6">
                            <div class="block-layout grid-layout vstack gap-2 panel overflow-hidden">
                                <div class="block-header panel pb-1">
                                    <h2
                                        class="h5 ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white position-relative underline-title">
                                        <strong class="dark:text-white">NASIONAL</strong>
                                    </h2>
                                </div>
                                <div class="block-content">
                                    <div class="row child-cols-12 g-2 lg:g-4 sep-x">
                                        @foreach ($postnasional as $index => $nasional)
                                        @if ($loop->first)
                                        <div class="col-12">
                                            <article class="post type-post panel vstack gap-1 lg:gap-2">
                                                <div class="post-media panel uc-transition-toggle overflow-hidden">
                                                    <div
                                                        class="featured-image bg-gray-25 dark:bg-gray-800 overflow-hidden ratio ratio-16x9">
                                                        @if (!empty($nasional->gambar) &&
                                                        is_array($nasional->gambar))
                                                        @php
                                                        $firstImage = $nasional->gambar[0];
                                                        @endphp
                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque rounded"
                                                            src="{{ asset('storage/' . $firstImage) }}"
                                                            data-src="{{ asset('storage/' . $firstImage) }}"
                                                            alt="{{ $nasional->title }}"
                                                            data-uc-img="loading: lazy" />
                                                        @endif
                                                    </div>
                                                    <a href="{{ route('bytitle', ['slug' => $nasional->slug]) }}"
                                                        class="position-cover"></a>
                                                </div>
                                                <div class="post-header panel">
                                                    <div
                                                        class="post-meta panel hstack justify-start gap-1 fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 md:d-flex z-1">
                                                        <div>
                                                            <div class="post-category hstack gap-narrow fw-medium">
                                                                <a class="text-none text-primary dark:text-white"
                                                                    href="{{ route('bycategory', ['categorySlug' => $nasional->kategori->slug]) }}">
                                                                    {{ $nasional->kategori->nama_kategori }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="sep md:d-block">❘</div>
                                                        <div class="md:d-block">
                                                            <div class="post-date text-start hstack gap-narrow">
                                                                <span>{{ $nasional->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h5
                                                        class="post-title h5 bold lg:h4 m-0 text-truncate-4">
                                                        <a class="text-none hover:text-primary duration-150"
                                                            href="{{ route('bytitle', ['slug' => $nasional->slug]) }}">
                                                            {{ $nasional->title }}
                                                        </a>
                                                    </h5>
                                                    <p
                                                        class="post-excerpt ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">
                                                        {!! Str::limit(strip_tags($nasional->content), 200) !!}
                                                    </p>
                                                    <!--<p class="fs-6 opacity-60 text-truncate-2">-->
                                                    <!--    {!! Str::limit($nasional->content, 150) !!}-->
                                                    <!--</p>-->
                                                </div>
                                            </article>
                                        </div>
                                        @else
                                        <div class="panel">
                                            <article class="post type-post panel">
                                                <div class="row child-cols g-3" data-uc-grid>
                                                    <div class="col-auto">
                                                        <div
                                                            class="post-media panel uc-transition-toggle overflow-hidden max-w-150px min-w-100px lg:min-w-150px">
                                                            <div
                                                                class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-16x9">
                                                                @if (!empty($nasional->gambar) &&
                                                                is_array($nasional->gambar))
                                                                @php
                                                                $firstImage = $nasional->gambar[0];
                                                                @endphp
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque rounded"
                                                                    src="{{ asset('storage/' . $firstImage) }}"
                                                                    data-src="{{ asset('storage/' . $firstImage) }}"
                                                                    alt="{{ $nasional->title }}"
                                                                    data-uc-img="loading: lazy" />
                                                                @endif
                                                            </div>
                                                            <a href="{{ route('bytitle', ['slug' => $nasional->slug]) }}"
                                                                class="position-cover"></a>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="post-header panel vstack justify-between gap-1">
                                                            <div
                                                                class="post-meta panel hstack justify-start gap-2 fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex z-1">
                                                                <div>
                                                                    <div
                                                                        class="post-category hstack gap-narrow fw-medium">
                                                                        <a class="text-none text-primary dark:text-white"
                                                                            href="{{ route('bycategory', ['categorySlug' => $nasional->kategori->slug]) }}">
                                                                            {{ $nasional->kategori->nama_kategori }}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <h6
                                                                class="post-title dark:text-white text-dark lg:h5 m-0 text-truncate-4">
                                                                <a class="text-none hover:text-primary duration-150"
                                                                    href="{{ route('bytitle', ['slug' => $nasional->slug]) }}">
                                                                    {{ $nasional->title }}
                                                                </a>
                                                            </h6>

                                                            <div
                                                                class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60">
                                                                <span>{{ $nasional->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        @endif
                                        @endforeach
                                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"
                                                 crossorigin="anonymous"></script>
                                            <ins class="adsbygoogle"
                                                 style="display:block"
                                                 data-ad-format="fluid"
                                                 data-ad-layout-key="-ib-k-s-6r+m4"
                                                 data-ad-client="ca-pub-7366174212541814"
                                                 data-ad-slot="5223869147"></ins>
                                            <script>
                                                 (adsbygoogle = window.adsbygoogle || []).push({});
                                            </script>
                                    </div>
                                </div>
                                <div class="block-footer cstack lg:mt-2">
                                    <a href="{{ route('bycategory', ['categorySlug' => 'nasional']) }}"
                                        class="animate-btn gap-0 btn btn-sm btn-alt-primary bg-transparent text-black dark:text-white border w-100">
                                        <span>Selengkapnya</span>
                                        <i class="icon fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        {{-- CATEGORY AWAL (LIFESTYLE) --}}
                        <div class="main-wrap panel vstack gap-3 lg:gap-6 py-3">
                            <div class="block-layout grid-layout vstack gap-2 panel overflow-hidden">
                                <div class="block-header panel pb-1">
                                    <h2
                                        class="h5 ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white position-relative underline-title">
                                        <strong class="dark:text-white">LIFESTYLE</strong>
                                    </h2>
                                </div>
                                <div class="block-content">
                                    <div class="row child-cols-12 g-2 lg:g-4 sep-x">
                                        @foreach ($postlifestyle as $index => $lifestyle)
                                        @if ($loop->first)
                                        <div class="col-12">
                                            <article class="post type-post panel vstack gap-1 lg:gap-2">
                                                <div class="post-media panel uc-transition-toggle overflow-hidden">
                                                    <div
                                                        class="featured-image bg-gray-25 dark:bg-gray-800 overflow-hidden ratio ratio-16x9">
                                                        @if (!empty($lifestyle->gambar) &&
                                                        is_array($lifestyle->gambar))
                                                        @php
                                                        $firstImage = $lifestyle->gambar[0];
                                                        @endphp
                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque rounded"
                                                            src="{{ asset('storage/' . $firstImage) }}"
                                                            data-src="{{ asset('storage/' . $firstImage) }}"
                                                            alt="{{ $lifestyle->title }}"
                                                            data-uc-img="loading: lazy" />
                                                        @endif
                                                    </div>
                                                    <a href="{{ route('bytitle', ['slug' => $lifestyle->slug]) }}"
                                                        class="position-cover"></a>
                                                </div>
                                                <div class="post-header panel">
                                                    <div
                                                        class="post-meta panel hstack justify-start gap-1 fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 md:d-flex z-1">
                                                        <div>
                                                            <div class="post-category hstack gap-narrow fw-medium">
                                                                <a class="text-none text-primary dark:text-white"
                                                                    href="{{ route('bycategory', ['categorySlug' => $lifestyle->kategori->slug]) }}">
                                                                    {{ $lifestyle->kategori->nama_kategori }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="sep md:d-block">❘</div>
                                                        <div class="md:d-block">
                                                            <div class="post-date text-start hstack gap-narrow">
                                                                <span>{{ $lifestyle->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h5
                                                        class="post-title h5 bold lg:h4 m-0 text-truncate-4">
                                                        <a class="text-none hover:text-primary duration-150"
                                                            href="{{ route('bytitle', ['slug' => $lifestyle->slug]) }}">
                                                            {{ $lifestyle->title }}
                                                        </a>
                                                    </h5>
                                                    <p
                                                        class="post-excerpt ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">
                                                        {!! Str::limit(strip_tags($lifestyle->content), 200) !!}
                                                    </p>
                                                    <!--<p class="fs-6 opacity-60 text-truncate-2 text-start">-->
                                                    <!--    {!! Str::limit($lifestyle->content, 70) !!}-->
                                                    <!--</p>-->
                                                </div>
                                            </article>
                                        </div>
                                        @else
                                        <div class="panel">
                                            <article class="post type-post panel">
                                                <div class="row child-cols g-3" data-uc-grid>
                                                    <div class="col">
                                                        <div
                                                            class="post-header panel vstack justify-between gap-1 text-end">
                                                            <div
                                                                class="post-meta panel hstack justify-end gap-2 fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex z-1">
                                                                <div>
                                                                    <div
                                                                        class="post-category hstack gap-narrow fw-medium">
                                                                        <a class="text-none text-primary dark:text-white"
                                                                            href="{{ route('bycategory', ['categorySlug' => $lifestyle->kategori->slug]) }}">
                                                                            {{ $lifestyle->kategori->nama_kategori }}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <h6
                                                                class="post-title dark:text-white text-dark lg:h5 m-0 text-truncate-4">
                                                                <a class="text-none hover:text-primary duration-150"
                                                                    href="{{ route('bytitle', ['slug' => $lifestyle->slug]) }}">
                                                                    {{ $lifestyle->title }}
                                                                </a>
                                                            </h6>
                                                            <div
                                                                class="post-date gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60">
                                                                <span
                                                                    class="text-end">{{ $lifestyle->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div
                                                            class="post-media panel uc-transition-toggle overflow-hidden max-w-150px min-w-100px lg:min-w-150px">
                                                            <div
                                                                class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-16x9">
                                                                @if (!empty($lifestyle->gambar) &&
                                                                is_array($lifestyle->gambar))
                                                                @php
                                                                $firstImage = $lifestyle->gambar[0];
                                                                @endphp
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque rounded"
                                                                    src="{{ asset('storage/' . $firstImage) }}"
                                                                    data-src="{{ asset('storage/' . $firstImage) }}"
                                                                    alt="{{ $lifestyle->title }}"
                                                                    data-uc-img="loading: lazy" />
                                                                @endif
                                                            </div>
                                                            <a href="{{ route('bytitle', ['slug' => $lifestyle->slug]) }}"
                                                                class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        @endif
                                        @endforeach
                                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"
                                                 crossorigin="anonymous"></script>
                                            <ins class="adsbygoogle"
                                                 style="display:block"
                                                 data-ad-format="fluid"
                                                 data-ad-layout-key="-hw+m-2g-a1+rw"
                                                 data-ad-client="ca-pub-7366174212541814"
                                                 data-ad-slot="4194419587"></ins>
                                            <script>
                                                 (adsbygoogle = window.adsbygoogle || []).push({});
                                            </script>
                                    </div>
                                </div>
                                <div class="block-footer cstack lg:mt-2">
                                    <a href="{{ route('bycategory', ['categorySlug' => 'lifestyle']) }}"
                                        class="animate-btn gap-0 btn btn-sm btn-alt-primary bg-transparent text-black dark:text-white border w-100">
                                        <span>Selengkapnya</span>
                                        <i class="icon fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        {{-- CATEGORY AWAL (TEKNOLOGI) --}}
                        <div class="main-wrap panel vstack gap-3 lg:gap-6">
                            <div class="block-layout grid-layout vstack gap-2 panel overflow-hidden">
                                <div class="block-header panel pb-1">
                                    <h2
                                        class="h5 ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white position-relative underline-title">
                                        <strong class="dark:text-white">TEKNOLOGI</strong>
                                    </h2>
                                </div>
                                <div class="block-content">
                                    <div class="row child-cols-12 g-2 lg:g-4 sep-x">
                                        @foreach ($postteknologi as $index => $teknologi)
                                        @if ($loop->first)
                                        <div class="col-12">
                                            <article class="post type-post panel vstack gap-1 lg:gap-2">
                                                <div class="post-media panel uc-transition-toggle overflow-hidden">
                                                    <div
                                                        class="featured-image bg-gray-25 dark:bg-gray-800 overflow-hidden ratio ratio-16x9">
                                                        @if (!empty($teknologi->gambar) &&
                                                        is_array($teknologi->gambar))
                                                        @php
                                                        $firstImage = $teknologi->gambar[0];
                                                        @endphp
                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque rounded"
                                                            src="{{ asset('storage/' . $firstImage) }}"
                                                            data-src="{{ asset('storage/' . $firstImage) }}"
                                                            alt="{{ $teknologi->title }}"
                                                            data-uc-img="loading: lazy" />
                                                        @endif
                                                    </div>
                                                    <a href="{{ route('bytitle', ['slug' => $teknologi->slug]) }}"
                                                        class="position-cover"></a>
                                                </div>
                                                <div class="post-header panel">
                                                    <div
                                                        class="post-meta panel hstack justify-start gap-1 fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 md:d-flex z-1">
                                                        <div>
                                                            <div class="post-category hstack gap-narrow fw-medium">
                                                                <a class="text-none text-primary dark:text-white"
                                                                    href="{{ route('bycategory', ['categorySlug' => $teknologi->kategori->slug]) }}">
                                                                    {{ $teknologi->kategori->nama_kategori }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="sep md:d-block">❘</div>
                                                        <div class="md:d-block">
                                                            <div class="post-date hstack gap-narrow">
                                                                <span>{{ $teknologi->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h5
                                                        class="post-title h5 bold lg:h4 m-0 text-truncate-4">
                                                        <a class="text-none hover:text-primary duration-150"
                                                            href="{{ route('bytitle', ['slug' => $teknologi->slug]) }}">
                                                            {{ $teknologi->title }}
                                                        </a>
                                                    </h5>
                                                    <p
                                                        class="post-excerpt ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">
                                                        {!! Str::limit(strip_tags($teknologi->content), 200) !!}
                                                    </p>
                                                    <!--<p class="fs-6 opacity-60 text-truncate-2">-->
                                                    <!--    {!! Str::limit($teknologi->content, 70) !!}-->
                                                    <!--</p>-->
                                                </div>
                                            </article>
                                        </div>
                                        @else
                                        <div class="panel">
                                            <article class="post type-post panel">
                                                <div class="row child-cols g-3" data-uc-grid>
                                                    <div class="col-auto">
                                                        <div
                                                            class="post-media panel uc-transition-toggle overflow-hidden max-w-150px min-w-100px lg:min-w-150px">
                                                            <div
                                                                class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-16x9">
                                                                @if (!empty($teknologi->gambar) &&
                                                                is_array($teknologi->gambar))
                                                                @php
                                                                $firstImage = $teknologi->gambar[0];
                                                                @endphp
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque rounded"
                                                                    src="{{ asset('storage/' . $firstImage) }}"
                                                                    data-src="{{ asset('storage/' . $firstImage) }}"
                                                                    alt="{{ $teknologi->title }}"
                                                                    data-uc-img="loading: lazy" />
                                                                @endif
                                                            </div>
                                                            <a href="{{ route('bytitle', ['slug' => $teknologi->slug]) }}"
                                                                class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="post-header panel vstack justify-between gap-1">
                                                            <div
                                                                class="post-meta panel hstack justify-start gap-2 fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex z-1">
                                                                <div>
                                                                    <div
                                                                        class="post-category hstack gap-narrow fw-medium">
                                                                        <a class="text-none text-primary dark:text-white"
                                                                            href="{{ route('bycategory', ['categorySlug' => $teknologi->kategori->slug]) }}">
                                                                            {{ $teknologi->kategori->nama_kategori }}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <h6
                                                                class="post-title dark:text-white text-dark lg:h5 m-0 text-truncate-4">
                                                                <a class="text-none hover:text-primary duration-150"
                                                                    href="{{ route('bytitle', ['slug' => $teknologi->slug]) }}">
                                                                    {{ $teknologi->title }}
                                                                </a>
                                                            </h6>

                                                            <div
                                                                class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60">
                                                                <span>{{ $teknologi->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        @endif
                                        @endforeach
                                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"
                                                 crossorigin="anonymous"></script>
                                            <ins class="adsbygoogle"
                                                 style="display:block"
                                                 data-ad-format="fluid"
                                                 data-ad-layout-key="-hw+m-2g-a1+rw"
                                                 data-ad-client="ca-pub-7366174212541814"
                                                 data-ad-slot="2330673572"></ins>
                                            <script>
                                                 (adsbygoogle = window.adsbygoogle || []).push({});
                                            </script>
                                    </div>

                                </div>
                                <div class="block-footer cstack lg:mt-2">
                                    <a href="{{ route('bycategory', ['categorySlug' => 'teknologi']) }}"
                                        class="animate-btn gap-0 btn btn-sm btn-alt-primary bg-transparent text-black dark:text-white border w-100">
                                        <span>Selengkapnya</span>
                                        <i class="icon fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        {{-- CATEGORY AWAL (OLAHRAGA) --}}
                        <div class="main-wrap panel vstack gap-3 lg:gap-6 py-3">
                            <div class="block-layout grid-layout vstack gap-2 panel overflow-hidden">
                                <div class="block-header panel pb-1">
                                    <h2
                                        class="h5 ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white position-relative underline-title">
                                        <strong class="dark:text-white">OLAHRAGA</strong>
                                    </h2>
                                </div>
                                <div class="block-content">
                                    <div class="row child-cols-12 g-2 lg:g-4 sep-x">
                                        @foreach ($postolahraga as $index => $olahraga)
                                        @if ($loop->first)
                                        <div class="col-12">
                                            <article class="post type-post panel vstack gap-1 lg:gap-2">
                                                <div class="post-media panel uc-transition-toggle overflow-hidden">
                                                    <div
                                                        class="featured-image bg-gray-25 dark:bg-gray-800 overflow-hidden ratio ratio-16x9">
                                                        @if (!empty($olahraga->gambar) &&
                                                        is_array($olahraga->gambar))
                                                        @php
                                                        $firstImage = $olahraga->gambar[0];
                                                        @endphp
                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque rounded"
                                                            src="{{ asset('storage/' . $firstImage) }}"
                                                            data-src="{{ asset('storage/' . $firstImage) }}"
                                                            alt="{{ $olahraga->title }}"
                                                            data-uc-img="loading: lazy" />
                                                        @endif
                                                    </div>
                                                    <a href="{{ route('bytitle', ['slug' => $olahraga->slug]) }}"
                                                        class="position-cover"></a>
                                                </div>
                                                <div class="post-header panel">
                                                    <div
                                                        class="post-meta panel hstack justify-start gap-1 fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 md:d-flex z-1">
                                                        <div>
                                                            <div class="post-category hstack gap-narrow fw-medium">
                                                                <a class="text-none text-primary dark:text-white"
                                                                    href="{{ route('bycategory', ['categorySlug' => $olahraga->kategori->slug]) }}">
                                                                    {{ $olahraga->kategori->nama_kategori }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="sep md:d-block">❘</div>
                                                        <div class="md:d-block">
                                                            <div class="post-date text-start hstack gap-narrow">
                                                                <span>{{ $olahraga->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h5
                                                        class="post-title h5 bold lg:h4 m-0 text-truncate-4">
                                                        <a class="text-none hover:text-primary duration-150"
                                                            href="{{ route('bytitle', ['slug' => $olahraga->slug]) }}">
                                                            {{ $olahraga->title }}
                                                        </a>
                                                    </h5>
                                                    <p
                                                        class="post-excerpt ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">
                                                        {!! Str::limit(strip_tags($olahraga->content), 200) !!}
                                                    </p>
                                                    <!--<p class="fs-6 opacity-60 text-truncate-2 text-start">-->
                                                    <!--    {!! Str::limit($olahraga->content, 70) !!}-->
                                                    <!--</p>-->
                                                </div>
                                            </article>
                                        </div>
                                        @else
                                        <div class="panel">
                                            <article class="post type-post panel">
                                                <div class="row child-cols g-3" data-uc-grid>
                                                    <div class="col">
                                                        <div
                                                            class="post-header panel vstack justify-between gap-1 text-end">
                                                            <div
                                                                class="post-meta panel hstack justify-end gap-2 fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex z-1">
                                                                <div>
                                                                    <div
                                                                        class="post-category hstack gap-narrow fw-medium">
                                                                        <a class="text-none text-primary dark:text-white"
                                                                            href="{{ route('bycategory', ['categorySlug' => $olahraga->kategori->slug]) }}">
                                                                            {{ $olahraga->kategori->nama_kategori }}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <h6
                                                                class="post-title dark:text-white text-dark lg:h5 m-0 text-truncate-4">
                                                                <a class="text-none hover:text-primary duration-150"
                                                                    href="{{ route('bytitle', ['slug' => $olahraga->slug]) }}">
                                                                    {{ $olahraga->title }}
                                                                </a>
                                                            </h6>
                                                            <div
                                                                class="post-date gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60">
                                                                <span
                                                                    class="text-end">{{ $olahraga->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div
                                                            class="post-media panel uc-transition-toggle overflow-hidden max-w-150px min-w-100px lg:min-w-150px">
                                                            <div
                                                                class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-16x9">
                                                                @if (!empty($olahraga->gambar) &&
                                                                is_array($olahraga->gambar))
                                                                @php
                                                                $firstImage = $olahraga->gambar[0];
                                                                @endphp
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque rounded"
                                                                    src="{{ asset('storage/' . $firstImage) }}"
                                                                    data-src="{{ asset('storage/' . $firstImage) }}"
                                                                    alt="{{ $olahraga->title }}"
                                                                    data-uc-img="loading: lazy" />
                                                                @endif
                                                            </div>
                                                            <a href="{{ route('bytitle', ['slug' => $olahraga->slug]) }}"
                                                                class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        @endif
                                        @endforeach
                                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"
                                                 crossorigin="anonymous"></script>
                                            <ins class="adsbygoogle"
                                                 style="display:block"
                                                 data-ad-format="fluid"
                                                 data-ad-layout-key="-hw+m-2g-a1+rw"
                                                 data-ad-client="ca-pub-7366174212541814"
                                                 data-ad-slot="8057642978"></ins>
                                            <script>
                                                 (adsbygoogle = window.adsbygoogle || []).push({});
                                            </script>
                                    </div>
                                </div>
                                <div class="block-footer cstack lg:mt-2">
                                    <a href="{{ route('bycategory', ['categorySlug' => 'olahraga']) }}"
                                        class="animate-btn gap-0 btn btn-sm btn-alt-primary bg-transparent text-black dark:text-white border w-100">
                                        <span>Selengkapnya</span>
                                        <i class="icon fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Iklan Section 1 start -->
                        <div class="section panel overflow-hidden">
                            <div class="section-outer panel mb-2">
                                <div class="container max-w-lg text-center">
                                    <div class="section-inner">
                                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"
                                             crossorigin="anonymous"></script>
                                        <!-- Under_Headline -->
                                        <ins class="adsbygoogle"
                                             style="display:block"
                                             data-ad-client="ca-pub-7366174212541814"
                                             data-ad-slot="1747750454"
                                             data-ad-format="auto"
                                             data-full-width-responsive="true"></ins>
                                        <script>
                                             (adsbygoogle = window.adsbygoogle || []).push({});
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Iklan Section 1 end -->
                        {{-- CATEGORY AWAL (OTOMOTIF) --}}
                        <div class="main-wrap panel vstack gap-3 lg:gap-6">
                            <div class="block-layout grid-layout vstack gap-2 panel overflow-hidden">
                                <div class="block-header panel pb-1">
                                    <h2
                                        class="h5 ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white position-relative underline-title">
                                        <strong class="dark:text-white">OTOMOTIF</strong>
                                    </h2>
                                </div>
                                <div class="block-content">
                                    <div class="row child-cols-12 g-2 lg:g-4 sep-x">
                                        @foreach ($postotomotif as $index => $otomotif)
                                        @if ($loop->first)
                                        <div class="col-12">
                                            <article class="post type-post panel vstack gap-1 lg:gap-2">
                                                <div class="post-media panel uc-transition-toggle overflow-hidden">
                                                    <div
                                                        class="featured-image bg-gray-25 dark:bg-gray-800 overflow-hidden ratio ratio-16x9">
                                                        @if (!empty($otomotif->gambar) &&
                                                        is_array($otomotif->gambar))
                                                        @php
                                                        $firstImage = $otomotif->gambar[0];
                                                        @endphp
                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque rounded"
                                                            src="{{ asset('storage/' . $firstImage) }}"
                                                            data-src="{{ asset('storage/' . $firstImage) }}"
                                                            alt="{{ $otomotif->title }}"
                                                            data-uc-img="loading: lazy" />
                                                        @endif
                                                    </div>
                                                    <a href="{{ route('bytitle', ['slug' => $otomotif->slug]) }}"
                                                        class="position-cover"></a>
                                                </div>
                                                <div class="post-header panel">
                                                    <div
                                                        class="post-meta panel hstack justify-start gap-1 fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 md:d-flex z-1">
                                                        <div>
                                                            <div class="post-category hstack gap-narrow fw-medium">
                                                                <a class="text-none text-primary dark:text-white"
                                                                    href="{{ route('bycategory', ['categorySlug' => $otomotif->kategori->slug]) }}">
                                                                    {{ $otomotif->kategori->nama_kategori }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="sep md:d-block">❘</div>
                                                        <div class="md:d-block">
                                                            <div class="post-date hstack gap-narrow">
                                                                <span>{{ $otomotif->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h5
                                                        class="post-title h5 bold lg:h4 m-0 text-truncate-4">
                                                        <a class="text-none hover:text-primary duration-150"
                                                            href="{{ route('bytitle', ['slug' => $otomotif->slug]) }}">
                                                            {{ $otomotif->title }}
                                                        </a>
                                                    </h5>
                                                    <p
                                                        class="post-excerpt ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">
                                                        {!! Str::limit(strip_tags($otomotif->content), 200) !!}
                                                    </p>
                                                    <!--<p class="fs-6 opacity-60 text-truncate-2">-->
                                                    <!--    {!! Str::limit($otomotif->content, 70) !!}-->
                                                    <!--</p>-->
                                                </div>
                                            </article>
                                        </div>
                                        @else
                                        <div class="panel">
                                            <article class="post type-post panel">
                                                <div class="row child-cols g-3" data-uc-grid>
                                                    <div class="col-auto">
                                                        <div
                                                            class="post-media panel uc-transition-toggle overflow-hidden max-w-150px min-w-100px lg:min-w-150px">
                                                            <div
                                                                class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-16x9">
                                                                @if (!empty($otomotif->gambar) &&
                                                                is_array($otomotif->gambar))
                                                                @php
                                                                $firstImage = $otomotif->gambar[0];
                                                                @endphp
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque rounded"
                                                                    src="{{ asset('storage/' . $firstImage) }}"
                                                                    data-src="{{ asset('storage/' . $firstImage) }}"
                                                                    alt="{{ $otomotif->title }}"
                                                                    data-uc-img="loading: lazy" />
                                                                @endif
                                                            </div>
                                                            <a href="{{ route('bytitle', ['slug' => $otomotif->slug]) }}"
                                                                class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="post-header panel vstack justify-between gap-1">
                                                            <div
                                                                class="post-meta panel hstack justify-start gap-2 fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex z-1">
                                                                <div>
                                                                    <div
                                                                        class="post-category hstack gap-narrow fw-medium">
                                                                        <a class="text-none text-primary dark:text-white"
                                                                            href="{{ route('bycategory', ['categorySlug' => $otomotif->kategori->slug]) }}">
                                                                            {{ $otomotif->kategori->nama_kategori }}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <h6
                                                                class="post-title dark:text-white text-dark lg:h5 m-0 text-truncate-4">
                                                                <a class="text-none hover:text-primary duration-150"
                                                                    href="{{ route('bytitle', ['slug' => $otomotif->slug]) }}">
                                                                    {{ $otomotif->title }}
                                                                </a>
                                                            </h6>

                                                            <div
                                                                class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60">
                                                                <span>{{ $otomotif->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        @endif
                                        @endforeach
                                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"
                                                 crossorigin="anonymous"></script>
                                            <ins class="adsbygoogle"
                                                 style="display:block"
                                                 data-ad-format="fluid"
                                                 data-ad-layout-key="-hw+m-2g-a1+rw"
                                                 data-ad-client="ca-pub-7366174212541814"
                                                 data-ad-slot="7363508405"></ins>
                                            <script>
                                                 (adsbygoogle = window.adsbygoogle || []).push({});
                                            </script>
                                    </div>

                                </div>
                                <div class="block-footer cstack lg:mt-2">
                                    <a href="{{ route('bycategory', ['categorySlug' => 'otomotif']) }}"
                                        class="animate-btn gap-0 btn btn-sm btn-alt-primary bg-transparent text-black dark:text-white border w-100">
                                        <span>Selengkapnya</span>
                                        <i class="icon fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        {{-- CATEGORY AWAL (DAERAH) --}}
                        <div class="main-wrap panel vstack gap-3 lg:gap-6 py-3">
                            <div class="block-layout grid-layout vstack gap-2 panel overflow-hidden">
                                <div class="block-header panel pb-1">
                                    <h2
                                        class="h5 ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white position-relative underline-title">
                                        <strong class="dark:text-white">DAERAH</strong>
                                    </h2>
                                </div>
                                <div class="block-content">
                                    <div class="row child-cols-12 g-2 lg:g-4 sep-x">
                                        @foreach ($postdaerah as $index => $daerah)
                                        @if ($loop->first)
                                        <div class="col-12">
                                            <article class="post type-post panel vstack gap-1 lg:gap-2">
                                                <div class="post-media panel uc-transition-toggle overflow-hidden">
                                                    <div
                                                        class="featured-image bg-gray-25 dark:bg-gray-800 overflow-hidden ratio ratio-16x9">
                                                        @if (!empty($daerah->gambar) && is_array($daerah->gambar))
                                                        @php
                                                        $firstImage = $daerah->gambar[0];
                                                        @endphp
                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque rounded"
                                                            src="{{ asset('storage/' . $firstImage) }}"
                                                            data-src="{{ asset('storage/' . $firstImage) }}"
                                                            alt="{{ $daerah->title }}"
                                                            data-uc-img="loading: lazy" />
                                                        @endif
                                                    </div>
                                                    <a href="{{ route('bytitle', ['slug' => $daerah->slug]) }}"
                                                        class="position-cover"></a>
                                                </div>
                                                <div class="post-header panel">
                                                    <div
                                                        class="post-meta panel hstack justify-start gap-1 fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 md:d-flex z-1">
                                                        <div>
                                                            <div class="post-category hstack gap-narrow fw-medium">
                                                                <a class="text-none text-primary dark:text-white"
                                                                    href="{{ route('bycategory', ['categorySlug' => $daerah->kategori->slug]) }}">
                                                                    {{ $daerah->kategori->nama_kategori }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="sep md:d-block">❘</div>
                                                        <div class="md:d-block">
                                                            <div class="post-date text-start hstack gap-narrow">
                                                                <span>{{ $daerah->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h5
                                                        class="post-title h5 bold lg:h4 m-0 text-truncate-4">
                                                        <a class="text-none hover:text-primary duration-150"
                                                            href="{{ route('bytitle', ['slug' => $daerah->slug]) }}">
                                                            {{ $daerah->title }}
                                                        </a>
                                                    </h5>
                                                    <p
                                                        class="post-excerpt ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">
                                                        {!! Str::limit(strip_tags($daerah->content), 200) !!}
                                                    </p>
                                                    <!--<p class="fs-6 opacity-60 text-truncate-2 text-start">-->
                                                    <!--    {!! Str::limit($daerah->content, 70) !!}-->
                                                    <!--</p>-->
                                                </div>
                                            </article>
                                        </div>
                                        @else
                                        <div class="panel">
                                            <article class="post type-post panel">
                                                <div class="row child-cols g-3" data-uc-grid>
                                                    <div class="col">
                                                        <div
                                                            class="post-header panel vstack justify-between gap-1 text-end">
                                                            <div
                                                                class="post-meta panel hstack justify-end gap-2 fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex z-1">
                                                                <div>
                                                                    <div
                                                                        class="post-category hstack gap-narrow fw-medium">
                                                                        <a class="text-none text-primary dark:text-white"
                                                                            href="{{ route('bycategory', ['categorySlug' => $daerah->kategori->slug]) }}">
                                                                            {{ $daerah->kategori->nama_kategori }}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <h6
                                                                class="post-title dark:text-white text-dark lg:h5 m-0 text-truncate-4">
                                                                <a class="text-none hover:text-primary duration-150"
                                                                    href="{{ route('bytitle', ['slug' => $daerah->slug]) }}">
                                                                    {{ $daerah->title }}
                                                                </a>
                                                            </h6>
                                                            <div
                                                                class="post-date gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60">
                                                                <span
                                                                    class="text-end">{{ $daerah->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div
                                                            class="post-media panel uc-transition-toggle overflow-hidden max-w-150px min-w-100px lg:min-w-150px">
                                                            <div
                                                                class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-16x9">
                                                                @if (!empty($daerah->gambar) &&
                                                                is_array($daerah->gambar))
                                                                @php
                                                                $firstImage = $daerah->gambar[0];
                                                                @endphp
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque rounded"
                                                                    src="{{ asset('storage/' . $firstImage) }}"
                                                                    data-src="{{ asset('storage/' . $firstImage) }}"
                                                                    alt="{{ $daerah->title }}"
                                                                    data-uc-img="loading: lazy" />
                                                                @endif
                                                            </div>
                                                            <a href="{{ route('bytitle', ['slug' => $daerah->slug]) }}"
                                                                class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                            
                                        </div>
                                        @endif
                                        @endforeach
                                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"
                                                 crossorigin="anonymous"></script>
                                            <ins class="adsbygoogle"
                                                 style="display:block"
                                                 data-ad-format="fluid"
                                                 data-ad-layout-key="-hw+m-2g-a1+rw"
                                                 data-ad-client="ca-pub-7366174212541814"
                                                 data-ad-slot="3483240620"></ins>
                                            <script>
                                                 (adsbygoogle = window.adsbygoogle || []).push({});
                                            </script>
                                    </div>
                                </div>
                                <div class="block-footer cstack lg:mt-2">
                                    <a href="{{ route('bycategory', ['categorySlug' => 'daerah']) }}"
                                        class="animate-btn gap-0 btn btn-sm btn-alt-primary bg-transparent text-black dark:text-white border w-100">
                                        <span>Selengkapnya</span>
                                        <i class="icon fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        {{-- BATAS TAMBAH CATEGORY BARU --}}
                    </div>

                    <div class="md:col-4" style="z-index: 2">
                        <div class="sidebar-wrap panel vstack gap-2 pb-2"
                            data-uc-sticky="end: .content-wrap; offset: 150; media: @m;">
                            <div class="widget ad-widget vstack gap-2 text-center">
                                <div class="panel gap-2 h-100">
                                    <div class="widget ad-widget vstack gap-2">
                                            <div class="widget-content">
                                                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"
                                                     crossorigin="anonymous"></script>
                                                <!-- square-2 -->
                                                <ins class="adsbygoogle"
                                                     style="display:block"
                                                     data-ad-client="ca-pub-7366174212541814"
                                                     data-ad-slot="3801428105"
                                                     data-ad-format="auto"
                                                     data-full-width-responsive="true"></ins>
                                                <script>
                                                     (adsbygoogle = window.adsbygoogle || []).push({});
                                                </script>
                                            </div>
                                        </div>
                                </div>
                            </div> <!-- End of Right Sidebar -->
                            <div class="widget popular-widget vstack gap-3 mt-5 border rounded-3 p-3">
                                <!-- Judul Sidebar -->
                                <div class="widget-title text-center">
                                    <h5 class="fs-7 fw-bold text-primary-category m-0">BERITA TERPOPULER</h5>
                                </div>

                                <!-- Daftar Topik -->
                                <div class="widget-content">
                                    <div class="row child-cols-12 gx-4 gy-3 sep-x" data-uc-grid>
                                        @foreach ($postTerpopuler as $index => $populer)
                                        <div>
                                            <article class="post type-post panel">
                                                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                    <!-- Ikon dan Nomor -->
                                                    <div class="hstack gap-2 align-items-center">
                                                        <div class="icon-circle bg-primary text-white text-center rounded-circle">
                                                            <span
                                                                class="h3 text-primary lg:h2 ft-tertiary fst-italic text-center m-0 min-w-24px">{{ $index + 1 }}</span>
                                                        </div>
                                                        <!-- Judul Topik -->
                                                        <div class="post-header panel vstack justify-between gap-1">
                                                            <h6 class="post-title m-0">
                                                                <a class="text-none text-dark hover:text-primary duration-150"
                                                                    href="{{ route('bytitle', $populer->slug) }}">
                                                                    {{ $populer->title }}
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Section end -->

<!-- Category Berita Terkini start -->
<div class="section panel overflow-hidden">
    <div class="section-outer panel py-1 mb-5">
        <div class="container max-w-lg">
            <div class="section-inner">
                <div class="block-layout grid-layout vstack gap-3 lg:gap-4 panel overflow-hidden">
                    <div class="block-header panel">
                        <div class="block-header panel pb-1">
                            <h2
                                class="h5 ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white position-relative underline-title">
                                <strong class="dark:text-white">BERITA TERKINI</strong>
                            </h2>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="panel row child-cols-12 md:child-cols gy-4 md:gx-3 xl:gx-4">
                            <div class="col-12 md:col-6 lg:col-8">
                                @foreach ($postTerkini as $index => $kini)
                                @if ($loop->first)
                                <div>
                                    <article class="post type-post panel vstack gap-1 lg:gap-2">
                                        <div class="post-media panel uc-transition-toggle overflow-hidden">
                                            <div
                                                class="featured-image bg-gray-25 dark:bg-gray-800 overflow-hidden ratio ratio-16x9">

                                                @if (!empty($kini->gambar) && is_array($kini->gambar))
                                                @php
                                                $firstImage = $kini->gambar[0];
                                                @endphp
                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque rounded"
                                                    src="{{ asset('storage/' . $firstImage) }}"
                                                    data-src="{{ asset('storage/' . $firstImage) }}"
                                                    alt="{{ $kini->title }}" data-uc-img="loading: lazy" />
                                                @endif
                                            </div>
                                            <a href="{{ route('bytitle', ['slug' => $kini->slug]) }}"
                                                class="position-cover"></a>
                                        </div>
                                        <div class="post-header panel">
                                            <div
                                                class="post-meta panel hstack justify-start gap-1 fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 md:d-flex z-1">
                                                <div>
                                                    <div class="post-category hstack gap-narrow fw-medium">
                                                        <a class="text-none text-primary dark:text-white"
                                                            href="{{ route('bycategory', ['categorySlug' => $kini->kategori->slug]) }}">{{ $kini->kategori->nama_kategori }}</a>
                                                    </div>
                                                </div>
                                                <div class="sep md:d-block">❘</div>
                                                <div class="md:d-block">
                                                    <div class="post-date hstack gap-narrow">
                                                        <span>{{ $kini->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <h5
                                                class="post-title dark:text-white text-dark lg:h4 m-0 text-truncate-4">
                                                <a class="text-none hover:text-primary duration-150"
                                                    href="{{ route('bytitle', ['slug' => $kini->slug]) }}">{{ $kini->title }}</a>
                                            </h5>
                                            <p
                                                class="post-excerpt ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">
                                                {!! Str::limit(strip_tags($kini->content), 200) !!}
                                            </p>
                                            <!--<p class="fs-6 opacity-60 text-truncate-2">-->
                                            <!--    {!! Str::limit($kini->content, 70) !!}-->
                                            <!--</p>-->

                                        </div>
                                    </article>
                                </div>
                            </div>
                            <div>
                                <div class="row child-cols-12 g-4 sep-x">
                                    @else
                                    <div>
                                        <article class="post type-post panel">
                                            <div class="row child-cols g-2" data-uc-grid>
                                                <div class="col-auto">
                                                    <div
                                                        class="post-media panel uc-transition-toggle overflow-hidden max-w-50px min-w-80px lg:min-w-100px">
                                                        <div
                                                            class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                            @if (!empty($kini->gambar) && is_array($kini->gambar))
                                                            @php
                                                            $firstImage = $kini->gambar[0];
                                                            @endphp
                                                            <img class="media-cover image uc-transition-scale-up uc-transition-opaque rounded"
                                                                src="{{ asset('storage/' . $firstImage) }}"
                                                                data-src="{{ asset('storage/' . $firstImage) }}"
                                                                alt="{{ $kini->title }}"
                                                                data-uc-img="loading: lazy" />
                                                            @endif
                                                        </div>
                                                        <a href="{{ route('bytitle', ['slug' => $kini->slug]) }}"
                                                            class="position-cover"></a>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="post-header panel vstack justify-between gap-1">
                                                        <div
                                                            class="post-meta panel hstack justify-start gap-1 fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex z-1">
                                                            <div>
                                                                <div
                                                                    class="post-category hstack gap-narrow fw-medium">
                                                                    <a class="text-none text-primary dark:text-white"
                                                                        href="{{ route('bycategory', ['categorySlug' => $kini->kategori->slug]) }}">
                                                                        {{ $kini->kategori->nama_kategori }}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <h6
                                                            class="post-title dark:text-white text-dark m-0 text-truncate-4">
                                                            <a class="text-none hover:text-primary duration-150"
                                                                href="{{ route('bytitle', ['slug' => $kini->slug]) }}">
                                                                {{ $kini->title }}
                                                            </a>
                                                        </h6>

                                                        <div
                                                            class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60">
                                                            <span>{{ $kini->created_at->diffForHumans() }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Category Berita Terkini End -->

    <!--{{-- Iklan Bawah (Dekstop) --}}-->
    <div class="ad-banner" id="adBanner">
        <div class="ad-close">
            <button class="close-ad-btn" id="closeAdBtn">Tutup Iklan ✖</button>
        </div>
        <div class="ad-content max-w-lg mx-auto">
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"
                 crossorigin="anonymous"></script>
            <!-- sticky-ads -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:728px;height:90px"
                 data-ad-client="ca-pub-7366174212541814"
                 data-ad-slot="2106843104"></ins>
            <script>
                 (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
@endsection


