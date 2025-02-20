@extends('blog.partials.app')

{{-- @section('title', 'Akun') --}}

@section('content')
    <section>
        <div class="container max-w-lg">
            <div class="row">
                <div class="col-md-8">
                    <aside class="wrapper__list__article">
                        <h4 class="border_section text-dark mb-4 dark:text-white">
                        </h4>

                        @foreach ($post as $item)
                            <!-- Post Article List -->
                            <div class="card__post card__post-list card__post__transition mb-4">
                                <article class="post type-post panel uc-transition-toggle">
                                    <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                        <div class="col-auto">
                                            <div
                                                class="post-media panel overflow-hidden max-w-150px min-w-100px lg:min-w-250px">
                                                <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                                    @if (!empty($item->gambar) && is_array($item->gambar))
                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                                            src="{{ asset('storage/' . $item->gambar[0]) }}"
                                                            data-src="{{ asset('storage/' . $item->gambar[0]) }}"
                                                            alt="{{ $item->title }}" data-uc-img="loading: lazy" />
                                                    @endif
                                                </div>
                                                <a href="{{ route('bytitle', $item->slug) }}" class="position-cover"></a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div
                                                class="post-meta panel hstack justify-start gap-1 mb-2 fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex z-1">
                                                <div>
                                                    <div class="post-category hstack gap-narrow fw-medium">
                                                        <a class="text-none text-primary dark:text-white"
                                                            href="{{ route('bycategory', $item->kategori->slug) }}">
                                                            {{ $item->kategori->nama_kategori }}
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="sep d-none md:d-block">❘</div>
                                                <div class="d-none md:d-block">
                                                    <div class="post-date hstack gap-narrow">
                                                        <span>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('DD MMMM, YYYY') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post-header panel vstack justify-between gap-1">
                                                <h3 class="post-title h5 lg:h4 m-0 text-truncate-2">
                                                    <a class="text-none hover:text-primary duration-150"
                                                        href="{{ route('bytitle', $item->slug) }}">
                                                        {{ $item->title }}
                                                    </a>
                                                </h3>
                                            </div>
                                            <p
                                                class="post-excerpt ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">
                                                {!! Str::limit(strip_tags($item->content), 200) !!}
                                            </p>
                                            <ul class="nav flex-wrap m-0">
                                                    <li class="list-inline-item">
                                                        <a href="#" class="badge bg-primary-tag text-white rounded-pill px-3 py-1 text-decoration-none">
                                                            {{ $tag->nama_tags }}
                                                        </a>
                                                    </li>
                                            </ul>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                        <div class="pagination-area mt-3">
                            {{ $post->onEachSide(2)->links('blog.partials.paginate') }}
                        </div>
                    </aside>
                </div>
                <!-- Sidebar -->
                <div class="col-lg-4">
                    @include('blog.side-detail')
                </div>
            </div>

        </div>
    </section>
@endsection
