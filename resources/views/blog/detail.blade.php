@extends('blog.partials.app')

{{-- @section('title', 'Akun') --}}

@section('content')
    <!-- Wrapper start -->
    <div id="wrapper" class="wrap overflow-hidden-x">

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

        <article class="post type-post single-post pb-4 lg:pb-6 xl:pb-9">
            <div class="container max-w-lg">
                <div class="row">
                    <!-- Main Content Area -->
                    <div class="col-lg-8">
                        <div class="mt-3">
                            <div class="post-header">
                                <div class="panel vstack text-center">
                                    <div class="panel vstack items-center max-w-400px sm:max-w-500px xl:max-w-md mx-auto">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb fs-6">
                                                <li class="breadcrumb-item">
                                                    <a href="{{ route('root') }}">
                                                        <i class="fa fa-home"></i>
                                                    </a>
                                                </li>

                                                <li class="breadcrumb-item {{ !$post->sub_category_id ? 'active' : '' }}">
                                                    @if(!$post->sub_category_id)
                                                        {{ $post->kategori->nama_kategori }}
                                                    @else
                                                        <a href="{{ route('bycategory', ['categorySlug' => $post->kategori->slug]) }}">
                                                            {{ $post->kategori->nama_kategori }}
                                                        </a>
                                                    @endif
                                                </li>

                                                @if($post->sub_category_id)
                                                    <li class="breadcrumb-item active">
                                                        {{ $post->kategori->subCateg->where('id', $post->sub_category_id)->first()->nama_sub_kategori }}
                                                    </li>
                                                @endif
                                            </ol>
                                        </nav>
                                        <h6 class="text-dark fs-4 dark:text-white lg:fs-1">{{ $post->title }}</h6>
                                        <div class="meta">
                                            <div class="hstack gap-2">
                                                <div class="post-author hstack gap-1">
                                                    <a href="{{ route('byauthor', ['slug' => $post->user->slug]) }}"
                                                       data-uc-tooltip="{{ $post->user->name }}">
                                                        <img src="{{ asset('assets/images/avatars/icon-profile.webp') }}" alt="{{ $post->user->name }}"
                                                             class="w-24px h-24px rounded-circle">
                                                    </a>
                                                    <a href="{{ route('byauthor', ['slug' => $post->user->slug]) }}"
                                                       class="text-black dark:text-white text-none fw-bold">{{ $post->user->name }}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-3" style="font-size: 12px;">{{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('l, d M Y') }}</p>
                                    </div>
                                    <figure class="featured-image m-0 ratio ratio-16x9">
                                        @if (!empty($post->gambar) && is_array($post->gambar))
                                            @php $firstImage = $post->gambar[0]; @endphp
                                            <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                                 src="{{ asset('storage/' . $firstImage) }}" data-src="{{ asset('storage/' . $firstImage) }}"
                                                 alt="{{ $post->title }}" data-uc-img="loading: lazy" />
                                        @endif
                                    </figure>
                                    <p class="mt-1" style="font-size: 12px; margin: 0; line-height: 1;">{{$post->image_caption }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Post Content -->
                        <div class="post-content-wrap panel">
                            <div class="max-w-900px">
                                <div class="post-content panel fs-6 md:fs-5">
                                    <div class="content-container dark:text-white">
                                        <!--{!! nl2br(preg_replace('/\[caption[^\]]*\](.*?)\[\/caption\]/s', '$1', $post->content)) !!}-->
                                        {!! nl2br(str_replace(['[caption]', '[/caption]'], '', $post->content)) !!}
                                    </div>
                                </div>
                                <ul class="nav flex-wrap m-0 mt-5">
                                    @foreach ($tagsdetail as $index => $tags)
                                        <li class="list-inline-item">
                                            <a href="{{ route('bytags', $tags->slug) }}"
                                               class="badge bg-primary-tag text-white rounded-pill px-3 py-1 text-decoration-none">
                                                {{ $tags->nama_tags }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <!--Iklan Section 1 start -->
                                    <div class="section panel overflow-hidden d-none d-md-block">
                                        <div class="section-outer panel p-5">
                                            <div class="container max-w-xl text-center">
                                                <div class="section-inner">
                                                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"
                                                         crossorigin="anonymous"></script>
                                                    <!-- square_article_detail -->
                                                    <ins class="adsbygoogle"
                                                         style="display:block"
                                                         data-ad-client="ca-pub-7366174212541814"
                                                         data-ad-slot="8791670950"
                                                         data-ad-format="auto"
                                                         data-full-width-responsive="true"></ins>
                                                    <script>
                                                         (adsbygoogle = window.adsbygoogle || []).push({});
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <!--Iklan Section 1 end -->
                                <div class="post-footer panel vstack sm:hstack gap-3 justify-between py-2">
                                    <ul class="post-share-icons nav-x gap-narrow">
                                        <li class="me-1"><span class="text-black dark:text-white">Share:</span></li>
                                        <li>
                                            <a id="share-facebook" class="btn btn-md btn-outline-gray-100 p-0 w-32px lg:w-40px h-32px lg:h-40px text-dark dark:text-white dark:border-gray-600 hover:bg-primary hover:border-primary hover:text-primary rounded-circle"
                                                href="#"><i class="fa-brands fa-facebook icon-1"></i></a>
                                        </li>
                                        <li>
                                            <a id="share-twitter" class="btn btn-md btn-outline-gray-100 p-0 w-32px lg:w-40px h-32px lg:h-40px text-dark dark:text-white dark:border-gray-600 hover:bg-primary hover:border-primary hover:text-primary rounded-circle"
                                                href="#"><i class="fa-brands fa-x-twitter icon-1"></i></a>
                                        </li>
                                        <li>
                                            <a id="share-instagram" class="btn btn-md btn-outline-gray-100 p-0 w-32px lg:w-40px h-32px lg:h-40px text-dark dark:text-white dark:border-gray-600 hover:bg-primary hover:border-primary hover:text-primary rounded-circle"
                                                href="#"><i class="fa-brands fa-instagram icon-1"></i></a>
                                        </li>
                                        <li>
                                            <a id="share-tiktok" class="btn btn-md btn-outline-gray-100 p-0 w-32px lg:w-40px h-32px lg:h-40px text-dark dark:text-white dark:border-gray-600 hover:bg-primary hover:border-primary hover:text-primary rounded-circle"
                                                href="#"><i class="fa-brands fa-tiktok icon-1"></i></a>
                                        </li>
                                        <li>
                                            <a id="share-telegram" class="btn btn-md btn-outline-gray-100 p-0 w-32px lg:w-40px h-32px lg:h-40px text-dark dark:text-white dark:border-gray-600 hover:bg-primary hover:border-primary hover:text-primary rounded-circle"
                                                href="#"><i class="fa-brands fa-telegram icon-1"></i></a>
                                        </li>

                                        <li>
                                            <a id="share-whatsapp" class="btn btn-md btn-outline-gray-100 p-0 w-32px lg:w-40px h-32px lg:h-40px text-dark dark:text-white dark:border-gray-600 hover:bg-primary hover:border-primary hover:text-primary rounded-circle"
                                                href="#"><i class="fa-brands fa-whatsapp icon-1"></i></a>
                                        </li>
                                        <li>
                                            <a id="share-link" class="btn btn-md btn-outline-gray-100 p-0 w-32px lg:w-40px h-32px lg:h-40px text-dark dark:text-white dark:border-gray-600 hover:bg-primary hover:border-primary hover:text-primary rounded-circle"
                                                href="#"><i class="fa-solid fa-link icon-1"></i></a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Related Posts Section -->
                               <div class="post-related panel border-top pt-2 xl:mt-5">
                                    <h4 class="h5 xl:h4">Topik Terkait:</h4>
                                    <div class="row child-cols-6 md:child-cols-3 gx-2 gy-4 sm:gx-3 sm:gy-6">
                                        @foreach ($relatedPosts as $index => $relate)
                                            <div>
                                                <article class="post type-post panel vstack gap-2">
                                                    <figure class="featured-image m-0 ratio ratio-4x3 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                                        @if (!empty($relate->gambar) && is_array($relate->gambar))
                                                            @php $firstImage = $relate->gambar[0]; @endphp
                                                            <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                                                 src="{{ asset('storage/' . $firstImage) }}"
                                                                 alt="{{ $relate->title }}" data-uc-img="loading: lazy">
                                                        @endif
                                                        <a href="{{ route('bytitle', ['slug' => $relate->slug]) }}" class="position-cover" data-caption="{{ $relate->title }}"></a>
                                                    </figure>
                                                    <div class="post-header panel vstack gap-1">
                                                        <h5 class="h6 md:h5 m-0">
                                                            <a class="text-none" href="{{ route('bytitle', ['slug' => $relate->slug]) }}">{{ $relate->title }}</a>
                                                        </h5>
                                                        <div class="post-date hstack gap-narrow fs-7 opacity-60">
                                                            <span>{{ $relate->created_at->translatedFormat('j F Y') }}</span>
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

                    <!-- Sidebar Area -->
                    <div class="col-lg-4">
                        @include('blog.side-detail')
                    </div>
                </div>
            </div>
        </article>



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

    </div>

    <!-- Wrapper end -->
@endsection
