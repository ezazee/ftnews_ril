@extends('blog.partials.app')

{{-- @section('title', 'Akun') --}}

@section('content')
    <div id="wrapper" class="wrap overflow-hidden-x">
        <div class="section">
            <div class="container max-w-lg">
                <div class="panel vstack gap-3">
                    <header class="custom-header text-center">
                        <!-- Judul Utama -->
                        <h1 class="h3 lg:h1">{{ $category->nama_kategori }}</h1>
                        <!-- Link Kategori -->
                        <nav class="custom-nav p-2">
                            @foreach($category->subCateg as $subCategory)
                                <a href="{{ route('bycategory', ['categorySlug' => $category->slug, 'subCategorySlug' => $subCategory->slug]) }}"
                                   class="custom-nav-link {{ Request::is('category/' . $category->slug . '/' . $subCategory->slug) ? 'active' : '' }}">
                                    {{ $subCategory->nama_sub_kategori }}
                                </a>
                            @endforeach
                        </nav>
                    </header>

                    <div class="row g-4 xl:g-8">
                        <div class="col">
                            <div class="panel text-center">
                                <div
                                    class="row child-cols-12 sm:child-cols-6 lg:child-cols-4 col-match gy-4 xl:gy-6 gx-2 sm:gx-4">
                                    @foreach ($post as $p)
                                    <div>
                                        <article class="post type-post panel vstack gap-2">
                                            <div class="post-image panel overflow-hidden">
                                                <figure
                                                    class="featured-image m-0 ratio ratio-16x9 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">

                                                    @if(!empty($p->gambar) && is_array($p->gambar))
                                                    @php
                                                        $firstImage = $p->gambar[0];
                                                    @endphp
                                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                                    src="{{ asset('storage/' . $firstImage) }}"
                                                    data-src="{{ asset('storage/' . $firstImage) }}"
                                                    alt="{{ $p->title }}"
                                                    data-uc-img="loading: lazy">
                                                @endif
                                                <a href="{{ route('bytitle', ['slug' => $p->slug]) }}" class="position-cover"
                                                    data-caption="{{ $p->title }}"></a>
                                                </figure>
                                                {{-- <div
                                                    class="post-category hstack gap-narrow position-absolute top-0 start-0 m-1 fs-7 fw-bold h-24px px-1 rounded-1 shadow-xs bg-white text-primary">
                                                    <a class="text-none" href="{{ route('bycategory', ['categorySlug' => $p->kategori->slug]) }}">{{ $p->kategori->nama_kategori }}</a>
                                                </div> --}}

                                                <div class="post-categories hstack gap-narrow position-absolute top-0 start-0 m-1 fs-7 fw-bold">
                                                    <div class="category-box h-24px px-1 rounded-1 shadow-xs bg-white text-primary">
                                                        <a class="text-none" href="{{ route('bycategory', ['categorySlug' => $p->kategori->slug]) }}">
                                                            {{ $p->kategori->nama_kategori }}
                                                        </a>
                                                    </div>

                                                    @if($p->subCategory)
                                                        <div class="category-box h-24px px-1 rounded-1 shadow-xs bg-white text-primary">
                                                            <a class="text-none" href="{{ route('bycategory', ['categorySlug' => $p->kategori->slug, 'subCategorySlug' => $p->subCategory->slug]) }}">
                                                                {{ $p->subCategory->nama_sub_kategori }}
                                                            </a>
                                                        </div>
                                                    @endif
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
                                                <h6 class="post-title text-dark dark:text-white sm:h5 xl:h4 m-0 text-truncate-4 m-0">
                                                    <a class="text-none" href="{{ route('bytitle', ['slug' => $p->slug]) }}">{{ $p->title }}</a>
                                                </h6>
                                                <div>
                                                    <div
                                                        class="post-meta panel hstack justify-center fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 md:d-flex">
                                                        <div class="meta">
                                                            <div class="hstack gap-2">
                                                                <div>
                                                                    <div class="post-author hstack gap-1">
                                                                        <a href="{{ route('byauthor', ['slug' => $p->user->slug]) }}"
                                                                            data-uc-tooltip="{{ $p->user->name }}"><img
                                                                                src="{{ asset('assets/images/avatars/icon-profile.webp') }}"
                                                                                alt="{{ $p->user->name }}"
                                                                                class="w-24px h-24px rounded-circle"></a>
                                                                        <a href="{{ route('byauthor', ['slug' => $p->user->slug]) }}"
                                                                            class="text-black dark:text-white text-none fw-bold">{{ $p->user->name }}</a>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="post-date hstack gap-narrow">
                                                                        <span>{{ $p->created_at->translatedFormat('j F Y') }}</span>
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

                                <div class="nav-pagination py-3 mt-6 lg:mt-9 border-top border-gray-100 dark:border-gray-800">
                                    <ul class="nav-x uc-pagination hstack gap-1 justify-center ft-secondary" data-uc-margin="">
                                        @if ($post->onFirstPage())
                                            <li class="uc-disabled">
                                                <span class="icon icon-1 fa-solid fa-chevron-left"></span>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ $post->previousPageUrl() }}">
                                                    <span class="icon icon-1 fa-solid fa-chevron-left"></span>
                                                </a>
                                            </li>
                                        @endif

                                        @php
                                            $currentPage = $post->currentPage();
                                            $lastPage = $post->lastPage();
                                            $startPage = max(1, $currentPage - 2);
                                            $endPage = min($lastPage, $currentPage + 2);
                                        @endphp

                                        @if ($startPage > 1)
                                            <li><a href="{{ $post->url(1) }}">1</a></li>
                                            @if ($startPage > 2)
                                                <li class="uc-disabled"><span>…</span></li>
                                            @endif
                                        @endif

                                        @for ($page = $startPage; $page <= $endPage; $page++)
                                            @if ($page == $currentPage)
                                                <li><a href="#" class="uc-active">{{ $page }}</a></li>
                                            @else
                                                <li><a href="{{ $post->url($page) }}">{{ $page }}</a></li>
                                            @endif
                                        @endfor

                                        @if ($endPage < $lastPage)
                                            @if ($endPage < $lastPage - 1)
                                                <li class="uc-disabled"><span>…</span></li>
                                            @endif
                                            <li><a href="{{ $post->url($lastPage) }}">{{ $lastPage }}</a></li>
                                        @endif
                                        @if ($post->hasMorePages())
                                            <li>
                                                <a href="{{ $post->nextPageUrl() }}">
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
