@extends('blog.partials.app')

@section('content')
    <div id="wrapper" class="wrap overflow-hidden-x">
        <div class="section py-3 sm:py-6 lg:py-9">
            <div class="container max-w-lg">
                <div class="panel vstack gap-3 sm:gap-6 lg:gap-9">
                    <header class="custom-header">
                        <div
                            class="post-author panel py-4 px-3 sm:p-3 xl:p-4 bg-gray-25 dark:bg-opacity-10 rounded lg:rounded-2">
                            <div class="row g-4 items-center">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <a class="fir-imageover" rel="noopener"
                                            href="#">
                                            <img class="fir-author-image" src="{{ asset('assets/images/avatars/icon-profile.webp') }}" width="150" height="150"
                                                alt="{{ $user->name }}">
                                        </a>
                                    </div>
                                    <div>
                                        <div class="panel vstack items-start gap-2 md:gap-3">
                                            <h4 class="h5 lg:h4 m-0">{{ $user->name }}</h4>
                                            <div
                                                class="post-category gap-narrow fs-7 fw-bold h-24px px-1 rounded-1 shadow-xs bg-white text-primary">
                                                Jumlah Postingan : {{ $postCount }}
                                            </div>
                                            <ul class="nav-x gap-1 text-gray-400 dark:text-white">
                                                <li>
                                                    <a href="#medium"><i class="icon-2 unicon-logo-medium"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#twitter"><i class="icon-2 unicon-logo-x-filled"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#instagram"><i class="icon-2 unicon-logo-linkedin"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </header>


                    <div class="row g-4 xl:g-8">
                        <div class="col">
                            <div class="panel text-center">
                                <div
                                    class="row child-cols-12 sm:child-cols-6 lg:child-cols-4 col-match gy-4 xl:gy-6 gx-2 sm:gx-4">
                                    @foreach ($posts as $item)
                                    <div>
                                        <article class="post type-post panel vstack gap-2">
                                            <div class="post-image panel overflow-hidden">
                                                <figure
                                                    class="featured-image m-0 ratio ratio-16x9 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">

                                                    @if(!empty($item->gambar) && is_array($item->gambar))
                                                    @php
                                                        $firstImage = $item->gambar[0];
                                                    @endphp
                                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                                    src="{{ asset('storage/' . $firstImage) }}"
                                                    data-src="{{ asset('storage/' . $firstImage) }}"
                                                    alt="{{ $item->title }}"
                                                    data-uc-img="loading: lazy">
                                                @endif
                                                <a href="{{ route('bytitle', ['slug' => $item->slug]) }}" class="position-cover"></a>
                                                </figure>
                                                <div
                                                    class="post-category hstack gap-narrow position-absolute top-0 start-0 m-1 fs-7 fw-bold h-24px px-1 rounded-1 shadow-xs bg-white text-primary">
                                                    <a class="text-none" href="{{ route('bycategory', ['categorySlug' => $item->kategori->slug]) }}">{{ $item->kategori->nama_kategori }}</a>
                                                </div>
                                                <div
                                                    class="position-absolute top-0 end-0 w-150px h-150px rounded-top-end bg-gradient-45 from-transparent via-transparent to-black opacity-50">
                                                </div>
                                                <span
                                                    class="cstack position-absolute top-0 end-0 fs-6 w-40px h-40px text-white">
                                                    <i class="icon-narrow unicon-play-filled-alt"></i>
                                                </span>
                                            </div>
                                            <div class="post-header panel vstack gap-1 lg:gap-2">
                                                <h3 class="post-title h6 sm:h5 xl:h4 m-0 text-truncate-2 m-0">
                                                    <a class="text-none hover:text-primary" href="{{ route('bytitle', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                                                </h3>
                                                <div>
                                                    <div
                                                        class="post-meta panel hstack justify-center fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                        <div class="meta">
                                                            <div class="hstack gap-2">
                                                                <div>
                                                                    <div class="post-date hstack gap-narrow">
                                                                        <span>{{ $item->created_at->translatedFormat('j F Y') }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="actions">
                                                            <div class="hstack gap-1"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="nav-pagination pt-3 mt-6 lg:mt-9 border-top border-gray-100 dark:border-gray-800">
                                    <ul class="nav-x uc-pagination hstack gap-1 justify-center ft-secondary" data-uc-margin="">
                                        @if ($posts->onFirstPage())
                                            <li class="uc-disabled">
                                                <span class="icon icon-1 fa-solid fa-chevron-left"></span>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ $posts->previousPageUrl() }}">
                                                    <span class="icon icon-1 fa-solid fa-chevron-left"></span>
                                                </a>
                                            </li>
                                        @endif

                                        @php
                                            $currentPage = $posts->currentPage();
                                            $lastPage = $posts->lastPage();
                                            $startPage = max(1, $currentPage - 2);
                                            $endPage = min($lastPage, $currentPage + 2);
                                        @endphp

                                        @if ($startPage > 1)
                                            <li><a href="{{ $posts->url(1) }}">1</a></li>
                                            @if ($startPage > 2)
                                                <li class="uc-disabled"><span>…</span></li>
                                            @endif
                                        @endif

                                        @for ($page = $startPage; $page <= $endPage; $page++)
                                            @if ($page == $currentPage)
                                                <li><a href="#" class="uc-active">{{ $page }}</a></li>
                                            @else
                                                <li><a href="{{ $posts->url($page) }}">{{ $page }}</a></li>
                                            @endif
                                        @endfor

                                        @if ($endPage < $lastPage)
                                            @if ($endPage < $lastPage - 1)
                                                <li class="uc-disabled"><span>…</span></li>
                                            @endif
                                            <li><a href="{{ $posts->url($lastPage) }}">{{ $lastPage }}</a></li>
                                        @endif
                                        @if ($posts->hasMorePages())
                                            <li>
                                                <a href="{{ $posts->nextPageUrl() }}">
                                                    <span class="icon icon-1 fa-solid fa-chevron-right"></span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="uc-disabled">
                                                <span class="icon icon-1 fa-solid fa-chevron-right"></span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
